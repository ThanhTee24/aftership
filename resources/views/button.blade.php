<div class="card-header flex-wrap py-3">
    <div hidden>
        <a href="{{route('page')}}" class="btn btn-success ">Tracking</a>
        {{--                                    <a href="{{route('paypal')}}" class="btn btn-success ">Paypal</a>--}}
    </div>
    <div class="card-title" style="border: 2px solid black;" hidden>
        <h3 class="card-label" hidden>Basic Demo
            <span class="d-block text-muted pt-2 font-size-sm">sorting &amp; pagination remote datasource</span>
        </h3>

    </div>
    <div class="card-toolbar">
        <!--begin::Button-->
        <!-- document.getElementById('BtnUpload').click(); -->

        <form id="upfile-button" class=" d-flex align-items-center" action="{{route('import')}}" method="post" enctype="multipart/form-data">@csrf
            <input type="file" name="files" id="type-file">
            <button type="submit" id="upload_file_start" class="square btn btn-outline-primary ">
                <i class="fa fa-rocket icon text-btnex d-flex align-items-center justify-content-center">Upfile</i>
            </button>
        </form>
        
        {{-- <form id="upfile-button" class=" d-flex align-items-center" action="{{route('import')}}" method="post" enctype="multipart/form-data">@csrf
            <input type="file" name="files" id="type-file">
            <button type="submit" id="upload_file_start" class="square btn btn-outline-primary ">
                <i class="fa fa-rocket icon text-btnex d-flex align-items-center justify-content-center">Upfile</i>
            </button>
        </form> --}}


        <script>
            $('#cancelBtn').click(function (e) {
                data.abort();
            });
            $(function () {
                $("#check_file").on("click", function () {
                    $("#uploadImg").click();
                });
                $('#uploadImg').fileupload({
                    url: url,
                    dataType: json,
                    autoUpload: false,
                    sequentialUploads: true,
                    maxNumberOfFiles: 1,
                    done: function (e, data) {
                        $('#files').append('Success!');
                    },
                }).on("fileuploadadd", function (e, data) {
                    $('#upload_file_start').click(function () {
                        jqXHR = data.submit();
                    });
                    $('#cancelBtn').click(function (e) {
                        jqXHR.abort();
                    });
                })
            });
        </script>


        <div class="dropdown ">
            <button id="myBtn" class=" dropbtn">Action</button>
            <div id="myDropdown" class="dropdown-content">
                <form>
                    <p type="button" id="export-file" class="btn-dropdown list-action d-flex align-items-center ">
                        <i class="fa fa-file-excel-o icon-md text-btn ">Expport</i>
                    </p>
                </form>

                <form class="btn_export">
                    <p type="button" class="export-modal btn-dropdown list-action  d-flex align-items-center " data-toggle="modal" data-target="#export-modal">
                        <i class="fa fa-cubes icon-md text-btn ">Op.export</i>
                    </p>
                </form>

                {{-- <a href="#about">About</a>
                <a href="#contact">Contact</a> --}}
            </div>
        </div>



        {{-- <form>
            <a  id="export-file" class="square btn btn-outline-primary">
                <i class="fa fa-file-excel-o icon-md text-btnex d-flex align-items-center justify-content-center font-action">Expport</i>
            </a>
        </form>

        <form>
            <a class="square export-modal btn btn-secondary btn-outline-info" data-toggle="modal"
               data-target="#export-modal">
                <i class="fa fa-cubes icon-md text-btnex d-flex align-items-center justify-content-center font-action">Op.export</i>
            </a>
        </form> --}}

        <form class="Op.export Op-export">
            <a class="square add-account-modal btn btn-secondary btn-outline-info" data-toggle="modal"
               data-target="#export-modal">
                <i class="fa fa-cubes icon-md text-btnex d-flex align-items-center justify-content-center font-action">Add.Paypall</i>
            </a>
        </form>

    </div>
</div>
