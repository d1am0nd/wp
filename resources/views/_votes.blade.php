@if(!Auth::check())
<script>
$(".votes-icon").on('click', function(event){
    event.preventDefault();
    $("#myModalLogin").modal();
});
</script>
@endif