<?php
    $api_url = "http://localhost/rest-api-crud/api/test_api.php?action=fetch_all";

    $client = curl_init($api_url);

    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($client);

    $result = json_decode($response);

    $output = "";

    if(count($result) > 0){
        $no = 1;
        foreach($result as $row){
            $output .="
            <tr>
                <td align='center'>".$no."</td>
                <td align='center'>".$row->nik."</td>
                <td align='center'>".$row->nama."</td>
                <td align='center'>".$row->no_telp."</td>
                <td align='center'>".$row->alamat."</td>
                <td align='center'><button type='button' name='edit' class='btn btn-warning btn-xs edit' id='".$row->id."'>EDIT</button></td>
                <td align='center'><button type='button' name='delete' class='btn btn-danger btn-xs delete' id='".$row->id."'>DELETE</button></td>
            </tr>
            ";
            $no++;
        }
    }
    else {
        $output .="
        <tr>
            <td colspan='4' align='center'>No Data Found</td> 
        </tr>
        ";
    }

    echo $output;

?>