$(document).ready(function(){

    loadLinks();
    addView();

    $("#lista-links").on("click", ".list-group", function(){
        let id_link = $(this).data("id_link");
        addClick(id_link);
    })

    function loadLinks(){

        $.get(window.location.origin + "/search-links-by-url", {
            url_name:$("#url_name").val()
        }).then(function(data) {
            if(data.status == 'success') {

                $("#lista-links").html("");

                if(data.data.length > 0){

                    for (var i in data.data) {

                        $("#lista-links").append(`
                        <div class="list-group" style="margin-bottom: 10px;" data-id_link="${data.data[i].id}">
                            <a target="_blank" rel=”noopener noreferrer” href="${data.data[i].link}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" style="background-color: ${data.data[i].color}; color: #fff">
                                ${data.data[i].icon}
                                <span>${data.data[i].name}</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        `);

                    }

                }

            } 
        }).catch();

    }

    function addClick(id_link){

        $.post(window.location.origin + "/add-click", {
            id_link:id_link
        }).then(function(data) {
            if(data.status == 'success') {


            } 
        }).catch();

    }

    function addView(){

        $.post(window.location.origin + "/add-view", {
            url_name:$("#url_name").val()
        }).then(function(data) {
            if(data.status == 'success') {


            } 
        }).catch();

    }

})