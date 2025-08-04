<?php

namespace App\Http\Controllers\Admin;

use App\Models\LanguageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

abstract class GenericController extends Controller
{

    protected $model;

    protected $title = 'Nomad';

    protected $vm = [];


    protected $table = [];

    protected $form = [];

    protected $actions = [];

    protected $tabs = [];

    protected $view = [];

    protected $export = [];


    protected $delete = true;

    protected $add = true;

    protected $edit = true;


    protected $unique = false;

    protected $sortable = false;

    protected $order = false;

    protected $pagination = true;

    protected $search = false;

    protected $fk = false;

    protected $includes = false;

    protected $translate = false;


    private $page_num = 10;


    public function __construct()
    {
    }

    /**
     * index
     * Monta a tela de listagem
     */
    public function index(Request $request)
    {
        if ($this->unique) {
            return redirect(route($request->route()->getName() . '.edit', ['id' => 1]));
        }

        if($this->sortable){
            $this->order = $this->sortable;
        }

        $this->vm['title'] = $this->title;
        $this->vm['table'] = $this->table;
        $this->vm['sortable'] = $this->sortable;
        $this->vm['pagination']= $this->pagination;
        $this->vm['search'] = $this->search;
        $this->vm['delete'] = $this->delete;
        $this->vm['edit'] = $this->edit;
        $this->vm['add'] = $this->add;
        $this->vm['view'] = $this->view;
        $this->vm['export'] = $this->export;

        // MODEL
        $items = (new $this->model);

        // INCLUDES
        if($this->includes){
            $includes = is_array($this->includes) ? $this->includes : [$this->includes];
            foreach($includes as $include){
                $items = $items->with($include);
            }
        }

        // FK
        if ($this->fk) {
            $items = $items->where($this->fk, $request->route('fk'));
        }

        // SEARCH
        if($this->search){
            $word = $request->query('search');
            if(!empty($word)){
                $arr = $this->search;
                if(!is_array($arr)){
                    $arr = [$arr];
                }
                $items = $items->where(function($query) use ($arr, $word){
                    foreach($arr as $search){
                        $query->orWhere($search, 'like', '%'.$word.'%');
                    }
                });
            }
        }

        // ORDER
        if ($this->order) {
            if(is_array($this->order)){
                $items = $items->orderBy($this->order[0], $this->order[1]);
            }else{
                $items = $items->orderBy($this->order);
            }
        }

        // PAGINATION
        $total = $items->count();
        $page = $request->query('page') ?? 1;

        $this->vm['paginator'] = [
            'page' => $page,
            'pages' => 1,
            'total' => $total,
        ];

        if($this->pagination && !$this->sortable){
            $items = $items
                ->offset(($page * $this->page_num) - $this->page_num)
                ->take($this->page_num);

            $this->vm['paginator']['pages'] = ceil($total / $this->page_num);
        }

        // RETORNO
        $items = $items->get();
        $this->vm['items'] = $items->toArray();

        return view("admin.pages.generic.index", $this->vm);
    }


    /**
     * form
     * Monta a tela de edição / inserção
     */
    public function form(Request $request)
    {
        $id = $request->route('id');
        $fk = $request->route('fk');

        if($id && !$this->edit){
            return redirect(route(str_replace(['.edit'], '', $request->route()->getName()), ['fk' => $fk]));
        }

        if(!$id && !$this->add){
            return redirect(route(str_replace(['.create'], '', $request->route()->getName()), ['fk' => $fk]));
        }

        $this->vm['title'] = $this->title;
        $this->vm['actions'] = $this->actions;
        $this->vm['form'] = $this->form;
        $this->vm['tabs'] = $this->tabs;
        $this->vm['translate'] = $this->translate;
        $this->vm['unique'] = $this->unique;
        $this->vm['value'] = [];

        if ($request->isMethod('post')) {
            $nid = $this->save($request, $id, $fk);

            if ($this->unique) {
                $redirect = redirect(route($request->route()->getName(), ['id' => 1]));
            } else {
                $redirect = redirect(route(str_replace(['.edit', '.create'], '', $request->route()->getName()), ['fk' => $fk]));
            }

            if($request->post('redirect')){

                if($id){
                    $url = request()->getRequestUri();
                }else{
                    $url = route(str_replace('.create', '.edit', $request->route()->getName()), ['id' => $nid]);
                }

                if (!session('last') || !is_array(session('last'))){
                    session(['last' => []]);
                }

                if(count(session('last')) == 0 || session('last')[count(session('last')) - 1] != $url){
                    $last = session('last');
                    $last[] = $url;
                    session(['last' => $last]);
                }

                $redirect = redirect(route($request->post('redirect'),['fk' => $nid]));
            }

            return $redirect->with('success', ($id ? 'Alterado' : 'Criado') . ' com sucesso!');

        }else{
            if ($id) {
                $this->vm['value'] = $this->load($id);
            }
        }

        return view("admin.pages.generic.edit", $this->vm);
    }


    /**
     * delete
     * Deleta o registro
     */
    public function delete(Request $request)
    {
        if(!$this->delete) return;
        $this->model::find($request->route('id'))->delete();
        return redirect(route(str_replace('.delete', '', $request->route()->getName()), ['fk' => $request->route('fk')]))
            ->with('success', 'Removido com sucesso!');
    }


    /**
     * sort
     * Salva o retorno do sortable
     */
    public function sort(Request $request)
    {
        $order = $request->input('order');
        foreach ($order as $position => $id) {
            $model = $this->model::find($id);
            $model->fill([$this->sortable => $position]);
            $model->save();
        }
        return response(['success' => true])->header('Content-Type', 'application/json');
    }

    /**
     * export
     * Gera a tela de visualização de dados
     */
    public function view(Request $request)
    {
        $id = $request->route('id');

        $this->vm['title'] = $this->title;
        $this->vm['view'] = $this->view;
        $this->vm['value'] = $this->load($id);

        return view("admin.pages.generic.view", $this->vm);
    }

    /**
     * export
     * Exporta para CSV
     */
    public function export(Request $request)
    {
        $result = '';
        foreach($this->export as $fields){
            $result .= $fields['label'].';';
        }
        $result .= chr(13).chr(10);

        // MODEL
        $items = (new $this->model);

        // INCLUDES
        if($this->includes){
            $includes = is_array($this->includes) ? $this->includes : [$this->includes];
            foreach($includes as $include){
                $items = $items->with($include);
            }
        }

        // FK
        if ($this->fk) {
            $items = $items->where($this->fk, $request->route('fk'));
        }

        // SEARCH
        if($this->search){
            $word = $request->query('search');
            if(!empty($word)){
                $arr = $this->search;
                if(!is_array($arr)){
                    $arr = [$arr];
                }
                $items = $items->where(function($query) use ($arr, $word){
                    foreach($arr as $search){
                        $query->orWhere($search, 'like', '%'.$word.'%');
                    }
                });
            }
        }

        // ORDER
        if ($this->order) {
            if(is_array($this->order)){
                $items = $items->orderBy($this->order[0], $this->order[1]);
            }else{
                $items = $items->orderBy($this->order);
            }
        }

        $data = $items->get()->toArray();

        foreach($data as $item){
            foreach($this->export as $fields){
                $result .= $item[$fields['name']].';';
            }
            $result .= chr(13).chr(10);
        }

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=export.csv',
            'Expires'             => '0',
            'Pragma'              => 'public',
        ];

        return response()->stream(function() use ($result){
            $fh = fopen('php://output', 'w');
            fwrite($fh, $result);
            fclose($fh);
        },200,$headers);
    }


    /***
     * PRIVATE FUNCTIONS -----------------------------------------------------------------------------------
     */

    private function load($id)
    {
        $items = (new $this->model);

        // INCLUDES
        if($this->includes){
            $includes = is_array($this->includes) ? $this->includes : [$this->includes];
            foreach($includes as $include){
                $items = $items->with($include);
            }
        }

        $data = $items->where('id', $id)->first();

        if ($data) {
            return $data->toArrayTranslation();
        }else{
            return [];
        }
    }

    private function save($request, $id, $fk)
    {
        $body = $request->all();

        if ($id) {
            $model = $this->model::find($id);
            if ($this->unique && !$model) {
                $model = new $this->model();
            }
        } else {
            $model = new $this->model();
        }
        $model->fill($request->all());

        $validators = [];
        foreach ($this->form as $cards) {
            foreach ($cards['inputs'] as $input) {
                $this->validator($request, $validators, $model, $input);
            }
        }
        foreach($this->vm['tabs'] as $tab){
            foreach($tab['form'] as $cards){
                foreach($cards['inputs'] as $input){
                    $this->validator($request, $validators, $model, $input);
                }
            }
        }
        $request->validate($validators);

        if ($this->fk) {
            $model->fill([
                $this->fk => $fk
            ]);
        }

        $model->save();

        foreach($this->form as $cards){
            foreach($cards['inputs'] as $input){
                if(isset($input['input']) && $input['input'] == 'table'){
                    if(isset($body[$input['name']])){
                        foreach($body[$input['name']] as $line){
                            if($line['deleted']){
                                if(!empty($line['id'])){
                                    $input['model']::find($line['id'])->delete();
                                }
                            }else{
                                $m = new $input['model'];
                                if(!empty($line['id'])){
                                    $m = $input['model']::find($line['id']);
                                }
                                $line[$input['fk']] = $model->id;
                                $m->fill($line);
                                $m->save();
                            }
                        }
                    }
                }else if(isset($input['input']) && $input['input'] == 'multiple'){
                    if(isset($body[$input['name']])){
                        foreach($body[$input['name']] as $line){
                            if(isset($line['id']) && !isset($line['checked'])){
                                $input['model']::find($line['id'])->delete();
                            }else if(!isset($line['id']) && isset($line['checked'])){
                                $m = new $input['model'];
                                $line[$input['fk']] = $model->id;
                                $m->fill($line);
                                $m->save();
                            }else if(isset($line['id']) && isset($line['checked'])){
                                $m = new $input['model'];
                                $m = $m->where('id', $line['id'])->first();
                                $line[$input['fk']] = $model->id;
                                $m->fill($line);
                                $m->save();
                            }
                        }
                    }
                }else if(isset($input['input']) && $input['input'] == 'gallery'){
                    if(isset($body[$input['name']])){
                        foreach($body[$input['name']] as $line){
                            if($line['deleted']){
                                if(!empty($line['id'])){
                                    $input['model']::find($line['id'])->delete();
                                }
                            }else{
                                $m = new $input['model'];
                                if(!empty($line['id'])){
                                    $m = $input['model']::find($line['id']);
                                }
                                if (!empty($line[$input['image']])) {
                                    if(is_string($line[$input['image']])){
                                        $name = $line[$input['image']];
                                    }else{
                                        $name = $line[$input['image']]->storeAs($input['folder'] ?? '', $this->generateFileName($line[$input['image']]), 'storage');
                                    }
                                    $m->fill([
                                        $input['image'] => $name,
                                        $input['sortable'] => $line['position']
                                    ]);
                                    $m->save();
                                }
                            }
                        }
                    }
                }
            }
        }

        return $model['id'];
    }

    private function validator($request, &$validators, &$model, $input)
    {
        $languages = LanguageModel::where('active', 1)->get()->toArray();

        if (isset($input['validators'])) {
            if(isset($input['translate']) && $input['translate']){
                foreach($languages as $lang){
                    $validators[$input['name']][$lang['slug']] = $input['validators'];
                }
            }else{
                $validators[$input['name']] = $input['validators'];
            }
        }

        if (isset($input['input']) && ($input['input'] == 'image' || $input['input'] == 'file')) {
            if (isset($input['translate']) && $input['translate']) {
                $file = $request->file($input['name']);
                foreach ($languages as $lang) {
                    if (isset($file[$lang['slug']])) {
                        $name = $file[$lang['slug']]->storeAs($input['folder'] ?? '', $this->generateFileName($file[$lang['slug']]), 'storage');
                        $model->setTranslation($input['name'], $lang['slug'], $name);
                    }
                }
            }else{
                $file = $request->file($input['name']);
                if ($file) {
                    $name = $file->storeAs($input['folder'] ?? '', $this->generateFileName($file), 'storage');
                    $model->fill([
                        $input['name'] => $name
                    ]);
                }
            }
        }
    }


    private function generateFileName($file){
        $parts = explode('.',$file->getClientOriginalName());
        $ext = array_pop($parts);
        $name = slugify(implode('',$parts));
        return $name.'-'.substr(sha1(date('dmyHis').rand(0,1000)), 0, 8).'.'.$ext;
    }

}
