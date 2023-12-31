<?php
require_once 'cek-akses.php';
if (empty($_POST['jawaban']) === false) {
    $pdo = include "koneksi.php";
    $totalSkor = 0;
    try {
        $pdo->beginTransaction();
        $queryHasil = $pdo->prepare("INSERT INTO hasil (id_user, tanggal, nilai)
        VALUES (:id_user, now(), 0)");
        $queryHasil->execute(array('id_user' => $_SESSION['user']['id']));
        $idHasil = $pdo->lastInsertId();
        foreach ($_POST['jawaban'] as $idPertanyaan => $idJawaban) {
            // Query pertanyaan
            $query = $pdo->prepare("select * from pertanyaan where id = :id");
            $query->execute(array("id" => $idPertanyaan));
            $pertanyaan = $query->fetch();
            // Query jawaban
            $query2 = $pdo->prepare("select * from jawaban where id = :id and id_pertanyaan = :id_pertanyaan");
            $query2->execute(array(
                'id' => $idJawaban,
                'id_pertanyaan' => $idPertanyaan
            ));
            $jawaban = $query2->fetch();
            $benar = 0;
            $isJawaban = null;
            if ($jawaban) {
                $idJawaban = $jawaban['id'];
                if ($jawaban['benar'] == 1) {
                    $totalSkor += $pertanyaan['skor'];
                    $benar = 1;
                }
            }
 
            $queryHasilJawaban = $pdo->prepare("INSERT INTO hasil_jawaban 
            (id_hasil, id_jawaban, benar, skor)
            VALUES (:id_hasil, :id_jawaban, :benar, :skor)");
            $queryHasilJawaban->execute(array(
                'id_hasil' => $idHasil,
                'id_jawaban' => $idJawaban,
                'benar' => $benar,
                'skor' => $pertanyaan['skor']
            ));
        }
 
        $queryUpdateSkor = $pdo->prepare("UPDATE hasil SET nilai=:nilai WHERE id=:id");
        $queryUpdateSkor->execute(array(
            'nilai' => $totalSkor,
            'id' => $idHasil
        ));
        $pdo->commit();
        header("Location: hasil.php?id=".$idHasil);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo $e->getMessage();
    }
}
?>