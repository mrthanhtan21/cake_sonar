<!DOCTYPE html>
<html>
<head>
    <title>Quản lý User</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <?php echo $this->Html->script('item-ajax.js'); ?>

</head>
<body>


<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Quản lý User</h2>
            </div>
            <div class="pull-right">
                <button style="margin-top: 20px" type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
                    Tạo mới User
                </button>
            </div>
        </div>
    </div>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Zipcode</th>
                <th width="200px">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $key => $user): ?>
                <tr>
                    <td>
                        <?= $key + 1 ?>
                    </td>
                    <td>
                        <?= $user->firstname ?>
                    </td>
                    <td>
                        <?= $user->lastname ?>
                    </td>
                    <td>
                        <?= $user->email ?>
                    </td>
                    <td>
                        <strong>Đường: </strong><?= $user->user_address['address_2']?>,
                        <strong>Phường: </strong><?= $user->user_address['province']?>,
                        <strong>Quận: </strong><?= $user->user_address['locality'] ?>,
                        <strong>Thành phố: </strong><?= $user->user_address['address_1'] ?>
                    </td>
                    <td>
                       <?= $user->user_address['zipcode'] ?>
                    </td>
                    <td>
                        <form method="post" id="form_detele_<?= $user->id?>" action="user/delete?id=<?= $user->id?>">
                            <button type="button" class="btn btn-danger confirm-delete" value=<?= $user->id?>>Delete</button>
                            <button type="button" class="btn btn-info edit_user" data-toggle="modal" data-target="#edit-item" value="<?= $user->id?>">Edit</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <ul id="pagination" class="pagination-sm"></ul>


    <!-- Create Item Modal -->
    <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tạo mới User</h4>
                </div>


                <div class="modal-body">
                    <form data-toggle="validator" action="./user/create" method="post">
                        <div class="form-group">
                            <label class="control-label" for="title">First Name:</label>
                            <input type="text" name="first_name" class="form-control" data-error="Please enter First Name." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Last Name:</label>
                            <input type="text" name="last_name" class="form-control" data-error="Please enter Last Name." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Email:</label>
                            <input type="text" name="email" class="form-control" data-error="Please enter Email Name." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Đường:</label>
                            <input type="text" name="address_2" class="form-control" data-error="Please enter Stress." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Phường:</label>
                            <input type="text" name="province" class="form-control" data-error="Please enter Province." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Quận:</label>
                            <input type="text" name="locality" class="form-control" data-error="Please enter Locality." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Thành Phố:</label>
                            <input type="text" name="address" class="form-control" data-error="Please enter City." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Zipcode:</label>
                            <input type="text" name="zipcode" class="form-control" data-error="Please enter Zipcode." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
                        </div>


                    </form>

                </div>
            </div>


        </div>
    </div>


    <!-- Edit Item Modal -->
    <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
                </div>


                <div class="modal-body">
                    <form id="edit-item" data-toggle="validator" action="user/create" method="post">
                        <input type="hidden" name="id" class="edit-id">


                        <div class="form-group">
                            <label class="control-label" for="title">First Name:</label>
                            <input type="text" name="first_name" class="form-control" data-error="Please enter First Name." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Last Name:</label>
                            <input type="text" name="last_name" class="form-control" data-error="Please enter Last Name." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Email:</label>
                            <input type="text" name="email" class="form-control" data-error="Please enter Email Name." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Đường:</label>
                            <input type="text" name="address_2" class="form-control" data-error="Please enter Stress." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Phường:</label>
                            <input type="text" name="province" class="form-control" data-error="Please enter Province." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Quận:</label>
                            <input type="text" name="locality" class="form-control" data-error="Please enter Locality." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Thành Phố:</label>
                            <input type="text" name="address" class="form-control" data-error="Please enter City." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="title">Zipcode:</label>
                            <input type="text" name="zipcode" class="form-control" data-error="Please enter Zipcode." required />
                            <div class="help-block with-errors"></div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
                        </div>


                    </form>


                </div>
            </div>
        </div>
    </div>


</div>
</body>
</html>
