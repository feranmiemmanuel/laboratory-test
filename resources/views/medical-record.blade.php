<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Records</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">X-Ray</h2>
        <table class="table table-bordered table-striped mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>X-Ray Details</th>
                    <th>Ultrasound Details</th>
                    <th>CT Scan</th>
                    <th>MRI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$name}}</td>
                    <td>
                        <?php
                        $xrayDetails = $content['x_ray'];
                        echo implode("<br>", $xrayDetails);
                        ?>
                    </td>
                    <td>
                        <?php
                        $ultrasoundDetails = $content['ultrasound_scan'];
                        echo implode("<br>", $ultrasoundDetails);
                        ?>
                    </td>
                    <td>{{$content['ct_scan']}}</td>
                    <td>{{$content['mri']}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>Created by Olasunkanmi Emmanuel Jesuferanmi</p>
    </footer>
</body>
</html>
