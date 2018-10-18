<html lang="pl">
<!doctype html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="src/css/bootstrap-custom.css">
</head>

<title>CMS Admin</title>
</head>
<body>
<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-12 content">
            <div class="panel panel-default panel-big">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel</h3>
                </div>

                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="panel panel-default panel-small">
                            <div class="panel-body">
                                <form role="form" method="post" action="?page=login">
                                    <input type="submit" value="Logout" class="btn btn-danger" style="float: right">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="panel panel-default panel-big">
                            <div class="panel-heading">
                                <h3 class="panel-title">Text</h3>
                            </div>
                            <div class="panel-body">
                                <?php echo $this->getData('text'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default panel-big">
                            <div class="panel-heading">
                                <h3 class="panel-title">Data</h3>
                            </div>
                            <div class="panel-body">
                                <div class="panel panel-default panel-small">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">ID</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo $this->getData('id'); ?>
                                    </div>
                                </div>
                                <div class="panel panel-default panel-small">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Imię :</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo $this->getData('first_name'); ?>
                                    </div>
                                </div>
                                <div class="panel panel-default panel-small">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Nazwisko :</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo $this->getData('last_name'); ?>
                                    </div>
                                </div>
                                <div class="panel panel-default panel-small">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Email :</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo $this->getData('email'); ?>
                                    </div>
                                </div>
                                <div class="panel panel-default panel-small">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Haslo :</h3>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo $this->getData('password'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>