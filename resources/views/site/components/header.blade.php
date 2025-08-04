<header class="header-holder">
    <div class="menu-wrapper center-relative relative">
        <div class="header-logo">
            <a href="/">
                <img src="assets/site/images/logo.png" style="width:150px" alt="Caliris">
            </a>
        </div>

        <div class="toggle-holder">
            <div id="toggle" class="">
                <div class="first-menu-line"></div>
                <div class="second-menu-line"></div>
                <div class="third-menu-line"></div>
            </div>
        </div>

        <div class="menu-holder">
            <nav id="header-main-menu">
                <ul class="main-menu sm sm-clean">
                    @foreach($trails as $key => $trail)
                        <li>
                            <a href="#trilha-{{$key}}">{{$trail['name']}}</a>
                        </li>
                    @endforeach
                    <li>
                        <a href="">BLOG</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="clear"></div>
    </div>
</header>