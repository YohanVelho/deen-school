function Tags(element) {

    let tags = [];
    const input = element.querySelector(".tag-container__input");
    const value = element.querySelector(".tag-container__value");

    function init() {
      tags = value.value ? JSON.parse(value.value) : [];
      addTags();
      input.addEventListener("keyup", keyup);
      element.addEventListener("click", remove);
    }

    function createTag(label) {
      const div = document.createElement("div");
      div.setAttribute("class", "tag");
      const span = document.createElement("span");
      span.innerHTML = label;
      const closeBtn = document.createElement("i");
      closeBtn.setAttribute("class", "material-icons close-btn");
      closeBtn.setAttribute("data-item", label);
      closeBtn.innerHTML = "close";
      div.appendChild(span);
      div.appendChild(closeBtn);
      return div;
    }

    function addTags() {
      reset();
      save();
      tags
        .slice()
        .reverse()
        .forEach((tag) => {
          element.prepend(createTag(tag));
        });
    }

    function reset() {
      element.querySelectorAll(".tag").forEach(function (tag) {
        tag.parentElement.removeChild(tag);
      });
    }

    function keyup(e) {
      if (e.key == "ArrowRight" || e.key == ",") {
        e.preventDefault();
        tags.push(input.value.replace(',',''));
        addTags();
        input.value = "";
      }
    }

    function remove(e) {
      if (e.target.tagName == "I") {
        const value = e.target.getAttribute("data-item");
        const index = tags.indexOf(value);
        tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
        addTags();
      }
    }

    function save() {
      value.value = JSON.stringify(tags);
    }

    return {
      init: init,
    };
  }
