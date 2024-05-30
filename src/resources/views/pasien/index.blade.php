<!DOCTYPE html>
<html>
<head>
    <title>Patient Information</title>
    <style>
        /* CSS styles for the patient information */
        .patient-info {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .patient-info h2 {
            margin-bottom: 10px;
        }
        .patient-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    @foreach($pasiens as $pasien)
    <div class="patient-info">
        <h2>Patient Information</h2>
        <p><strong>Name :</strong> {{$pasien->name}}</p>
        <p><strong>Gender :</strong> {{$pasien->gender}}</p>
        <p><strong>Age :</strong> {{$pasien->umur}}</p>
        <p><strong>Penyakit :</strong> {{$pasien->penyakit}}</p>
        <p><strong>Alamat :</strong> {{$pasien->alamat}}</p>
    </div>
    @endforeach
</body>
</html>