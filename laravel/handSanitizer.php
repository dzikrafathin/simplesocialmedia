<?php
    class HandSanitizer {

        public function beli($beli){
            if ($beli == 0) {
                return "Tidak boleh kosong";
            } else if ($beli > 5) { 
                return "Pembelian tidak boleh lebih dari 5";
            } else if ($beli < 0) {
                return "Jumlah yang dimasukan tidak valid";
            } else {
                return "Pembelian berhasil, akan dikirimkan";
            }
        }

    }
?>