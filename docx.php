<?php
require('con.php');

if (isset($_POST['action'])) {
    $url = $_POST['url'];
    $data = $_POST['docx-merger'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1000);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'docx-merger=' . $data);
    $response = curl_exec($ch);
    curl_close($ch);
    die;
}

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <!-- <meta http-equiv="refresh" content="30"> -->
    <style>
        body {
            margin: 2em 3em;
        }

        .dt-buttons {
            margin-bottom: 10px;
        }

        .dt-buttons.btn-group {
            float: left;
            margin-right: 2%;
        }

        .dataTables_filter {
            float: left;
            margin-top: 4px;
            margin-right: 2%;
            text-align: left;
        }

        .dataTables_info {
            float: right;
        }

        .dataTables_length {
            float: right;
            margin-top: 4px;
            margin-left: 2%;
        }

        .select2-container {
            width: 100% !important;
        }

        p.pname {
            cursor: pointer;
        }

        /* Absolute Center Spinner */
        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));

            background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 150ms infinite linear;
            -moz-animation: spinner 150ms infinite linear;
            -ms-animation: spinner 150ms infinite linear;
            -o-animation: spinner 150ms infinite linear;
            animation: spinner 150ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="loading">Loading&#8230;</div>
    <h2>Docx Merger</h2>

    <table id="status" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Domain</th>
                <th>Order Id</th>
                <th>Date Time</th>
                <th>Status</th>
                <th>Product Thumbnail</th>
                <th>Product Name</th>
                <th>Product Book File</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody class="data">

        </tbody>
    </table>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Docx Merger</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container text-center">
                        <div class="card">
                            <div class="card-body">
                                <div class="data">
                                    <input type="hidden" class="pid_docx">
                                    <div class="card p-2">
                                        <table class="table">
                                            <thead>
                                                <th>Code</th>
                                                <th>Subjects</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    <div class="py-2">
                                        <select class="form-control code" name="code" id="">
                                            <option value="">Select Subject</option>
                                        </select>
                                    </div>
                                </div>
                                <textarea name="formHtml" class="form-control" id="formHtml" cols="30" rows="5" placeholder="Description"></textarea>
                                <input type="text" name="" id="output_name" required placeholder="Output Name" class="form-control my-2">
                                <button type="button" class="btn btn-success generate_docx my-3">Generate Docx</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.js"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(async () => {
        $(document).on('click', '.pname', function() {
            $('.pid_docx').val($(this).attr('data-id'));
        });
        $(document).find('.code').select2()
        var settings;
        var fdata = [];

        var formdata = new FormData();
        formdata.append("action", "get_data");
        formdata.append("key", "fraud_detector_options");
        formdata.append("table", "fraud_detector_options");

        var requestOptions = {
            method: 'POST',
            body: formdata,
            redirect: 'follow'
        };

        fetch("https://lookhype.com/endpoint.php", requestOptions)
            .then(response => response.json())
            .then(result => console.log(response_multisite(JSON.parse(result.value).site_urls.split(','))))
            .catch(error => console.log('error', error));

        await fetch('https://examinspect.com/wp-json/au/v1/printer-options')
            .then(response => response.json())
            .then(data => settings = data);

        let url = settings.spreadsheet_url;

        $.get(url, function(r) {
            var data = csvtoarray(r)
            data.map(e => {
                fdata.push("<option value='" + e.Code + ', ' + e["Topics\r"] + "'>" + e.Code + ', ' + e["Topics\r"] + "</option>")
            })
            $('.code').append(fdata)
        })

        $('.code').on('change', (e) => {
            var l = $('.code').val().split(', ');
            $('.data .card table tbody').append("<tr><td class='align-middle code_label'>" + l[0] + "</td><td class='align-middle code_subject'>" + l[1] + "</td><td class='align-middle'><button type='button' class='btn btn-danger dismiss'>X</button></td></tr>")
        })


        $(document).on('click', '.dismiss', function(e) {
            $(this).parent('td').parent('tr').remove()
        })

        $(document).on('click', '.generate_docx', function(e) {
            if ($('#output_name').val() == '') {
                alert('Please Enter Output Name');
            } else {
                var d = {
                    code: [],
                    subject: [],
                    desc: "",
                    output: ''
                }
                $('.data table tbody tr .code_label').each((e, i) => {
                    d.code.push(i.innerHTML)
                });
                $('.data table tbody tr .code_subject').each((e, i) => {
                    d.subject.push(i.innerHTML)
                });
                d.desc = $('#formHtml').val();
                d.output = $('#output_name').val();

                $.post(window.location.href, {
                    "docx-merger": JSON.stringify(d),
                    url: settings.server_ip,
                    action: 'submit'
                })
                alert('Send To Server');
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }
        })
    })

    async function response_multisite(urls) {
        var all_orders = [];
        await Promise.all(urls.map(url =>
            fetch(url + 'wp-json/au/v1/attribute/get_all_order', {
                method: 'POST'
            })
            .then(checkStatus) // check the response of our APIs
            .then(parseJSON) // parse it to Json
            .catch(error => console.log('There was a problem!', error))
        )).then(data => {
            data.filter(item => item).map(x => {
                all_orders = [...all_orders, ...x]
            })
        })
        var formdata = new FormData();
        formdata.append("data", JSON.stringify(all_orders));
        await fetch("/docx-helper.php", {
                method: 'POST',
                body: formdata,
                redirect: 'follow'
            })
            .then(response => response.text())
            .then(result => data_insert(result))
            .catch(error => console.log('error', error));
    }

    function data_insert(r) {
        $('tbody.data').append(r)
        $('#status').DataTable({
            // "ajax": 'docx-helper.php',
            "pageLength": 50,
            'order': [
                [2, 'desc']
            ]
        });
        $('.loading').addClass('d-none');
    }

    function csvtoarray(data, delimiter = ',') {

        const titles = data.slice(0, data
            .indexOf('\n')).split(delimiter);

        const titleValues = data.slice(data
            .indexOf('\n') + 1).split('\n');

        const ansArray = titleValues.map(function(v) {
            const values = v.split(delimiter);
            const storeKeyValue = titles.reduce(
                function(obj, title, index) {
                    obj[title] = (values[index] != undefined ? values[index].trim() : values[index]);
                    return obj;
                }, {});

            return storeKeyValue;
        });

        return ansArray;
    };

    function checkStatus(response) {
        if (response.ok) {
            return Promise.resolve(response);
        } else {
            return Promise.reject(new Error(response.statusText));
        }
    }

    function parseJSON(response) {
        return response.json();
    }

    const sleep = m => new Promise(r => setTimeout(r, m))
</script>

</html>

</html>