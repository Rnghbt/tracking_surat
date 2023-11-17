import requests

url = "http://103.100.27.59/~lacaksurat/add_history_disposisi.php"

payload = "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"p_tiket_id\"\r\n\r\nTKT1ABC\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"p_id_pegawai_penerima\"\r\n\r\n2\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"p_keterangan\"\r\n\r\nXXXXXXXXXXXX\r\n-----011000010111000001101001--\r\n"
headers = {
    "Content-Type": "multipart/form-data; boundary=---011000010111000001101001",
    "id_pegawai": "1"
}

response = requests.request("POST", url, data=payload, headers=headers)

print(response.text)
