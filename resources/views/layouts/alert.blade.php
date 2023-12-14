
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "500",
                "hideDuration": "500",
                "timeOut": "3000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            @if(Session::has('success'))
            toastr["success"]("{{Session::get('success')}}")
            @endif

            @if(Session::has('error'))
                toastr["error"]("{{session('error')}}")
            @endif



        });


    </script>
