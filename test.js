import axios from "axios";

const form = new FormData();

const options = {
    method: 'GET',
    url: 'http://103.100.27.59/~lacaksurat/list_surat.php',
    headers: {
        id_pegawai: '1',
        'Content-Type': 'multipart/form-data; boundary=---011000010111000001101001'
    },
    data: '[form]'
};

axios.request(options).then(function (response) {
    console.log(response.data);
}).catch(function (error) {
    console.error(error);
});
