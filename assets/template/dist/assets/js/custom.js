/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

$(document).ready(function(){
  $('#table-1').dataTable();
  $('#summernote').summernote();
  $(document).on('click', 'a[data-role=ta]', function() {
        var id = $(this).data('id');
        var judul = $('#'+id).children('td[data-target=judul]').text();
        var pengadu = $('#'+id).children('td[data-target=pengadu]').text();

        $('#judulLap').val(judul);
        $('#pengadu').val(pengadu);
        $('#tanggapi').modal('toggle');

  });
});
