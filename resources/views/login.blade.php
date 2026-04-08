<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NTBK Store Tasikmalaya | Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box" style="margin-top: -100px">
        <div class="login-logo">
            <a href="/"><b>NTBK Store </b>Tasikmalaya</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Email / Password anda salah</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <p class="login-box-msg">Silahkan login terlebih dahulu</p>
                <form action="/login" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-4">
                            <div class="loading"></div>
                            <button type="submit" id="btnLogin" class="btn btn-primary btn-block ">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="{{ asset('assets') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/dist/js/adminlte.min.js"></script>

    <script>
        $(document).on('click', '#btnLogin', function () {
             let email = $('#email').val();
             let password = $('#password').val();

             if (email == '') {
                 $('#email').addClass('is-invalid');
             } else if(password == '') {
                 $('#password').addClass('is-invalid');
             } else {
                 $('#btnLogin').addClass('d-none');
                 $('.loading').html(`
                    <button class="btn btn-primary" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Login...
                    </button>
                 `);
             }
        });
    </script>
</body>

</html>