function clearInputGroupField(item, event) {
    $(item).closest('.input-group').find(':input')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
}

function reloadTooltips() {
    $('.tip').tooltip();
    reloadPopovers();
}

function reloadPopovers() {
    $('.popover').popover();
}

function submitFilterForm(item, event)
{
    $(item).closest('form').find('button:submit').click();
}

function clearFilterForm(item, event)
{
    $(item).closest('form').find(':input')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');

    $(item).closest('form').submit();
}

function clearForm( form ) {
    $(form).find(':input')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');
}

function dump(arr, level) {
    var dumped_text = "";
    if(!level) level = 0;

    //The padding given at the beginning of the line.
    var level_padding = "";
    for(var j=0;j<level+1;j++) level_padding += "    ";

    if(typeof(arr) == 'object') { //Array/Hashes/Objects
        for(var item in arr) {
            var value = arr[item];

            if(typeof(value) == 'object') { //If it is an array,
                dumped_text += level_padding + "'" + item + "' ...\n";
                dumped_text += dump(value,level+1);
            } else {
                dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
            }
        }
    }
    else { //Stings/Chars/Numbers etc.
        dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
    }

    return alert(dumped_text);
}

function showLoader()
{
    $('#loading-wrapper').slideDown(500);
}

function hideLoader()
{
    $('#loading-wrapper').slideUp(500);
}

function toggleLoader()
{
    $('#loading-wrapper').slideToggle(300);
}

function updateSidebarSettings(item, event)
{
    console.log('call updateSidebarSettings();');

    console.log( $(item).find('#itemsPerPage').val() );

    // var input = $(item).closest('.input-group').find('input');
    // var postObj = {
    //     activity: input.val()
    // };

    $.post($(item).prop('action'), $(item).serialize(), function(data) {
        if ( data.errno ) {
            // showMsgBox(data.html, 'warning');
            console.log('test1');
        }
        else {
            console.log('test2');
        }
    }, 'json')
        .fail(function(err){
            console.log('test3');
            // showMsgBox( 'Error #'+ err.status +': '+ err.statusText, 'error' );
        });
}

function toogleAllIndexItems(item, event)
{
    $(item).closest('table').find('tbody tr>td input').prop('checked', $(item).prop('checked'));
}

function bulkDeleteSubmit(item, event)
{
    console.log('bulkDeleteSubmit()');
    var selectedItemsCount = $(item).closest('table').find('tbody input:checked').length;

    if ( selectedItemsCount == 0 )
    {
        alert('You must select at least one element!');
        return false;
    }

    if ( confirm('Are you sure you want to bulk delete '+ selectedItemsCount +' items?') ){
        if ( confirm('100% sure?') ) {
            $(item).closest('table').find('tbody form').submit();
        }
    }

}

function bulkRestoreSubmit(item, event)
{
    console.log('bulkRestoreSubmit()');
    var selectedItemsCount = $(item).closest('table').find('tbody input:checked').length;

    if ( selectedItemsCount == 0 )
    {
        alert('You must select at least one element!');
        return false;
    }


    if ( confirm('Are you sure you want to bulk restore '+ selectedItemsCount +' items?') ){
        if ( confirm('100% sure?') ) {
            $(item).closest('table').find('tbody form').submit();
        }
    }

}

