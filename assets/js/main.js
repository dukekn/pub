function _close(t){
    $('section.results_container').removeClass('hidden');
    $(t).addClass('hidden');
}

$('#select_all').on('change',  function(event) {
    if($(this).is(':checked'))
    {
        $('tbody input').each( function() {
            $(this).prop("checked", true);
        });
        toggleDeleteBtn($(this));

    }else{
        $('tbody input').each( function() {
            $(this).prop("checked", false);
        });
        toggleDeleteBtn($(this));
    }
});

$('tbody input[type="checkbox"]').on('change', function ()
{
    toggleDeleteBtn($(this));
});

function toggleDeleteBtn(el)
{
    var checked = $('tbody input:checked').length;
    var total_checkboxes = $('thead input').length;

    if($(el).is(':checked'))
    {
        $('#delete_multiple').removeClass('hidden');
        if(total_checkboxes == checked)
        {
            $('#select_all').prop('checked', true);
        }
    }else{
        if(checked == 0)
        {
            $('#delete_multiple').addClass('hidden');
            $('#select_all').prop('checked', false);
        }
    }
}

function deleteSingle(id , el)
{
    var conf = confirm("Are you sure that you want to delete that record?");
    if (conf == true) {
        fetch( 'ajax/deleteSingle', {
            method: 'POST',
            headers: new Headers({
                'Content-Type': 'application/x-www-form-urlencoded', // <-- Specifying the Content-Type
            }),
            body: "id="+id // <-- Post parameters
        })
            .then((response) => response.text())
            .then((responseText) => {
                console.log(responseText);
                $(el).closest('tr').remove();
            })
            .catch((error) => {
                console.error(error);
            });

    } //conf == true ?
}

$('#delete_multiple').on('click' , function (){
    var conf = confirm("Are you sure you want to delete the selected records?");
    if (conf == true) {

        if( $('tbody input:checked').length > 0 ){  // at least one  checked
            var ids = [];

            $('tbody input:checked').each(function(){
                if($(this).is(':checked')) {
                    ids.push($(this).val());
                }
            });
            var ids_string = ids.toString();  // array to string conversion

            fetch( 'ajax/deleteMultiple', {
                method: 'POST',
                headers: new Headers({
                    'Content-Type': 'application/x-www-form-urlencoded', // <-- Specifying the Content-Type
                }),
                body: "id_arr="+ids_string // <-- Post parameters
            })
                .then((response) => response.text())
                .then((responseText) => {
                    console.log(responseText );
                    $(ids).each(function(index, el) {
                        $('tr[data-id="'+el+'"]').remove();
                    });
                    toggleDeleteBtn(false);
                    $('#select_all').prop('checked', false);

                })
                .catch((error) => {
                    console.error(error);
                });

        }

    }
});




$('#create').on('click' , function (){
    $('section.results_container').addClass('hidden');
    $('section.create').removeClass('hidden');
});

$('section.create  button').on('click' , function (){
    $('section.create .alert').remove();
    var alert = '<span class="alert">This field is empty or invalid!</span>';
    var invalids =  $('section.create input:invalid, section.create select:invalid');

    if(invalids.length > 0)
    {
        invalids.each(function (e){
            $(alert).insertAfter($(this));
        })
    }else{
        var formData = new FormData();
        $('section.create *[name]').each(function (){
            var name = $(this).attr('name');
            var value = $(this).val();
            formData.append(name,value);
        });

        fetch( 'ajax/create', {
            method: 'POST',
            body: formData // <-- Post parameters
        })
            .then((response) => response.text())
            .then((responseText) => {
                location.reload();
            })
            .catch((error) => {
                console.error(error);
            });
    }
});

function submit_edit(){
    $('section.edit .alert').remove();
    var alert = '<span class="alert">This field is empty or invalid!</span>';
    var invalids =  $('section.edit input:invalid, section.edit select:invalid');

    if(invalids.length > 0)
    {
        invalids.each(function (e){
            $(alert).insertAfter($(this));
        })
    }else{
        var formData = new FormData();
        $('section.edit *[name]').each(function (){
            var name = $(this).attr('name');
            var value = $(this).val();
            formData.append(name,value);
        });

        fetch( 'ajax/edit', {
            method: 'POST',
            body: formData // <-- Post parameters
        })
            .then((response) => response.text())
            .then((responseText) => {
                location.reload();
            })
            .catch((error) => {
                console.error(error);
            });
    }
}

function getSingle(id){
    var formData = new FormData();
    formData.append('id',id);
    fetch( 'ajax/getSingle', {
        method: 'POST',
        body: formData // <-- Post parameters
    })
        .then((response) => response.text())
        .then((responseText) => {
            $('section.edit').html(responseText);
            $('section.results_container').addClass('hidden');
            $('section.edit').removeClass('hidden');
        })
        .catch((error) => {
            console.error(error);
        });
}
