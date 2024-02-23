
@push("scripts")
<script>
Swal.fire({
//   title: "Good job!",
  text: "{{$message}}",
//   icon: "success"
 @php
 if(isset($error)) 
 {
    echo 'icon:"error"';
 }
 else {
    echo 'icon:"success"';
 }
 
 @endphp 

}).then(function(){
   document.getElementById("query").focus()
})
</script>
@endpush     
