class Search {

    constructor(id_input, id_search, lista) {
    	this.input = document.getElementById(id_input);
		this.search= document.getElementById(id_search);
		this.list = lista;
       	this.watch(this.input, this.list, this.search);
    }

    watch(input, list, search) {
        input.addEventListener('keyup', () => {
            search.innerHTML = '';
            let value = input.value.toLowerCase(),
                listT = list.length,
                existe = 0;

            for (let i = 0; i < listT; i++) {
                let text = list[i].toLowerCase();
                if (value != '') {
                    existe = ~text.indexOf(value);
                    if (existe != 0) {
                        this.updateList(search, list[i]);
                    }
                }
            }
        }, false);
    }

    updateList(el, text) {
        el.innerHTML += `<li class="list-group-item list-group-item-action" onclick=updateInput('${text}') style="padding:5px;">${text}</li>`;
    }


    add(item) {
        this.list.push(item);
    }

    remove(item) {
        let position = this.list.indexOf(item);
        this.list.splice(position, 1);
    }

}