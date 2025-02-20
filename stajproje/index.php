<style>
        body {
            background: white;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: blue;
        }

        table {
            border-collapse: collapse;
            width: 85%;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        hr {
            border: 1px solid blue;
            margin: 20px 0;
        }
    </style>
<center>
<body>

<h1> BANKA DB UYGULAMASI</h1> <!-- HTML basligi: ilk satirda baslik etiketi <h1> kullanilarak "BANKA DB UYGULAMASI" basligi olusturulmus.-->
<hr>
<br> <!--bosluk-->
<br>

<br>
<?php //php kodu basliyor
require 'dbconfig.php'; //bconfig.php dosyasinin dahil edilmesi: require 'dbconfig.php'; satiri, dbconfig.php dosyasini 
//bu kodun icine dahil eder. Bu dosya, muhtemelen veritabani baglantisi ve diger yapilandirmalar icin gereklidir.
echo "<br><br><h1>Müşteri Listesi</h1><br><br>";//HTML ciktisi: echo ifadesi kullanilarak, "Musteriler" basligi yazdirilir: echo "<br><br><h1>Musteriler</h1><br><br>";
$sql = "SELECT * FROM musteri"; //SQL sorgusu: Bir SQL sorgusu olusturulur: $sql = "SELECT * FROM musteri";. Bu sorgu, "musteri" tablosundaki 
//tum verileri secer. Yani, musteri tablosundaki tum kayitlari alir.
echo "<br>"; 
// Sorguyu calistirir
$result = $conn->query($sql); //Sorgunun calistirilmasi: $conn->query($sql); ifadesiyle SQL sorgusu veritabanina gonderilir ve sonuclar alinir.

if ($result === false) { //Sonuc kontrolu: $result === false ifadesiyle, sorgunun basarisiz olup olmadigi kontrol edilir.
    echo"<br>";
    die("Sorgu hatasi: " . $conn->error . "<br>Sorgu: " . $sql); //basarisizlik durumu: eger sorgu basarisiz olursa, hata mesaji ve hatanin nedeni ekrana 
    //yazdirilir: die("Sorgu hatasi: " . $conn->error . "<br>Sorgu: " . $sql);
}


$count = 0;
if ($result->num_rows > 0) { //Veritabani sorgusunun sonucunda kayit bulundugu durumu kontrol eder. 
    

    echo "<table>"; //HTML tablosu olusturulmaya baslanir. 

   
    echo "<tr>"; // Tablonun baslik satiri olusturulmaya baslanir.
  
    $firstRow = $result->fetch_assoc(); //İlk satirin verilerini bir dizi olarak alir.
    $columns = array_keys($firstRow);// Tablonun baslik sutunlarini alir.
    foreach ($columns as $column) {//Baslik sutunlari HTML tablosuna eklenir. //foreach: her eleman icin biseyler yapar
        echo "<th>$column</th>"; //php dili icerisinde html kodu yazmamisaglayan sey
    } //$:her variablenin basina bu isaret konur. yoksa normal metinmis gibi algilar.
    echo "</tr>";//Baslik satiri tamamlanir

    // İlk veriyi isleme kodlarina ekleyin
    $count += 1;//Sayaci artirir (ilk satir icin).
    echo "<tr>";//Tablonun icerik satiri olusturulmaya baslanir.
    foreach ($firstRow as $value) {  
        echo "<td>$value</td>";
    } //İlk satirin degerleri HTML tablosuna eklenir.
    echo "</tr>";//İlk satirin satir etiketi tamamlanir.

    // Diger veri setlerini isleme kodlari
    while ($row = $result->fetch_assoc()) { //Veritabanindan diger satirlar alinir ve bu satirlarin icerikleri tabloya eklenir.
        $count += 1;//Sayaci artirir (diger satirlar icin).
        echo "<tr>";//Tablonun icerik satiri olusturulmaya baslanir.
        foreach ($row as $value) { 
            echo "<td>$value</td>";
        } //Diger satirlarin degerleri HTML tablosuna eklenir.
        echo "</tr>"; //Diger satirlarin satir etiketi tamamlanir.
    }

    echo "</table>"; //HTML tablosu tamamlanir.

    echo "Toplam Kayit Sayisi: $count";//Tabloda toplam kayit sayisini ekrana yazdirir.
} else { //Eger sorgu sonucunda hicbir kayit yoksa bu blok calisir.
    echo "<br>";
    echo "Tabloda veri bulunamadi.";
} //Veri bulunamadigina dair mesaj ekrana yazdirilir.

echo "<hr><br><br><br><h1>Veritabaninda Bulunan Bankalar</h1><br><br>";//"Bankalar" basligi eklenir.



$sql = "SELECT * FROM banka"; //Baska bir sorgu hazirlanir.
$result = $conn->query($sql);// İkinci sorguyu calistirir ve sonucu alir.

if ($result === false) {//İkinci sorgunun basarisiz olup olmadigi kontrol edilir.
    echo"<br>";
    die("Sorgu hatasi: " . $conn->error . "<br>Sorgu: " . $sql);//Eger sorgu basarisiz olmussa hata mesajini ekrana yazdirir ve islemi sonlandirir.
}


$count = 0;
if ($result->num_rows > 0) { //Bu satir, SQL sorgusu sonucunda donen satir sayisinin sorguda kayit bulunup bulunmadigini kontrol eder. Eger sonucta en az bir
    // satir varsa, if bloguna girilir.
    

    echo "<table>";//Bu satir, bir HTML tablosu olusturmak icin <table> etiketini yazdirir.

   
    echo "<tr>";//Bu satir, bir HTML tablosunda baslik satirini olusturmak icin <tr> etiketini yazdirir.
  
    $firstRow = $result->fetch_assoc();//Bu satir, ilk satirin (ilk kayit) verilerini iceren bir iliskisel diziyi ($firstRow) alir. 
    //$result bir sonuc kumesidir ve fetch_assoc() yontemi, sonuc kumesinin bir sonraki satirini iliskisel bir dizi olarak getirir.
    $columns = array_keys($firstRow); //Bu satir, $firstRow dizisinin anahtarlarini (sutun adlarini) iceren bir dizi olan $columns dizisini olusturur.
    foreach ($columns as $column) { //Bu dongu, $columns dizisindeki her sutun adi icin bir baslik hucresi <th> olusturur ve sutun adini tabloya ekler.
        echo "<th>$column</th>";
    }
    echo "</tr>";//Bu satir, baslik satirini tamamlamak icin </tr> etiketini yazdirir.

   
    $count += 1;//Bu satir, sayaci artirir ve ilk kayit icin kullanilir.
    echo "<tr>";//Bu satir, veri satirini olusturmak icin <tr> etiketini acar.
    foreach ($firstRow as $value) { //Bu dongu, $firstRow dizisindeki her deger icin bir veri hucresi <td> olusturur ve degeri tabloya ekler.
        echo "<td>$value</td>";
    }
    echo "</tr>"; //Bu satir, veri satirini tamamlamak icin </tr> etiketini yazdirir.

   
    while ($row = $result->fetch_assoc()) { //Bu dongu, sonraki satirlardaki verileri islemek icin bir dongu baslatir. Her bir satirin 
        //verilerini $row dizisine atar ve donguye girer.
        $count += 1;//Bu satir, dongu her calistiginda sayaci bir artirir ve toplam kayit sayisini hesaplamak icin kullanilir.
        echo "<tr>";//Bu satir, veri satirini olusturmak icin <tr> etiketini acar.
        foreach ($row as $value) { //Bu dongu, $row dizisindeki her deger icin bir veri hucresi <td> olusturur ve degeri tabloya ekler.
            echo "<td>$value</td>";
        }
        echo "</tr>";//Bu satir, veri satirini tamamlamak icin </tr> etiketini yazdirir.
    }

    echo "</table>"; // Bu satir, tabloyu tamamlar ve </table> etiketini yazdirir.

    echo "Toplam Kayit Sayisi: $count"; //Bu satir, toplam kayit sayisini ekrana yazdirir.
} else { //Eger baslangicta if kosulu dogru degilse (yani sonuc kumesinde hic kayit yoksa), bu bloga girilir.
    echo "<br>";//bosluk
    echo "Tabloda veri bulunamadi.";//veri bulunamadi mesajini ekrana yazdirir
}

echo "<hr><br><br><br><h1>Şirket Listesi</h1><br><br>";// bir satir bir baslik(h1) ekler ve altta iki satir bosluk birakir

$sql = "SELECT * FROM Sirket";//Bu satir, yeni bir SQL sorgusu olusturur. "Sirket" tablosundan tum verileri secer.

$result = $conn->query($sql); //Bu satir, yeni sorguyu veritabanina gonderir ve sonuc kumesini $result degiskenine atar.

if ($result === false) {//Bu satir, sorgu hatasi kontrolu yapar. Eger sorgu basarisiz olursa if bloguna girer.
    echo"<br>";
    die("Sorgu hatasi: " . $conn->error . "<br>Sorgu: " . $sql);//Bu satir, bir hata olusursa ekrana hata mesajini ve sorguyu yazdirir ve islemi sonlandirir.
}


$count = 0; //Bu degisken, toplam kayit sayisini tutmak icin kullanilir ve baslangicta sifira ayarlanir.
if ($result->num_rows > 0) { //Bu if kosulu, sorgudan donen satir sayisinin 0'dan buyuk oldugunu kontrol eder. Yani, sorgu sonucunda tabloda veri oldugu durumu belirler.
    

    echo "<table>";// HTML tablosunun baslangicini olusturur.

    
    echo "<tr>";//HTML tablosundaki baslik satirinin baslangicini olusturur.
   
    $firstRow = $result->fetch_assoc();//İlk veri satirini ceker ve $firstRow degiskenine saklar.
    $columns = array_keys($firstRow);//$firstRow dizisinin sutun isimlerini iceren bir dizi olusturur.
    foreach ($columns as $column) { //Sutun isimlerini iceren diziyi dongu ile dolasarak her birini baslik hucresi olarak ekrana yazdirir.
        echo "<th>$column</th>";
    }
    echo "</tr>";//HTML tablosundaki baslik satirinin sonunu olusturur.

    
    $count += 1;//Toplam kayit sayisini artirir. Bu baslik satirini saymaz, sadece veri satirlarini sayar.
    echo "<tr>";// İlk veri satirinin baslangicini olusturur.
    foreach ($firstRow as $value) {//İlk veri satirindaki verileri dongu ile dolasarak her birini bir tablo hucresi olarak ekrana yazdirir.
        echo "<td>$value</td>";
    }
    echo "</tr>";//İlk veri satirinin sonunu olusturur.A

    
    while ($row = $result->fetch_assoc()) {//Veritabanindan diger veri satirlarini alir ve dongu ile her birini bir tablo satiri olarak ekrana yazdirir.
        $count += 1;//Toplam kayit sayisini artirir. Bu adimda veri satirlarini sayar.
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";//HTML tablosunun sonunu olusturur.
    }

    echo "</table>";

    echo "Toplam Kayit Sayisi: $count";//Toplam kayit sayisini ekrana yazdirir.
} else { //Eger sorgu sonucunda hicbir veri yoksa (num_rows 0), bu blok calisir ve "Tabloda veri bulunamadi." ifadesini ekrana yazar.
    echo "<br>";
    echo "Tabloda veri bulunamadi.";
}

//0
echo "<hr><br><br><br><h1>Kisisel Hesap Listesi</h1><br><br>";//HTML baslik etiketi (<h1>) ile "Kisisel Hesap" metnini ekrana yazdirir.

$sql = //"musteri", "kisisel_hesap" ve "banka" tablolarini kullanarak bir SQL sorgusu olusturur. Bu sorgu, "musteri" ve "banka" tablolarindaki verileri
// "kisisel_hesap" tablosu uzerinden birlestirerek ceker ve "Musteri" ve "Banka" sutunlarina sahip bir sonuc kumesi dondurur.
"SELECT musteri.musteri_ad AS Musteri , banka.banka_ad AS Banka
FROM musteri 
JOIN kisisel_hesap 
JOIN banka 
ON musteri.musteri_id = kisisel_hesap.musteri_id && banka.banka_id = kisisel_hesap.banka_id";

$result = $conn->query($sql);//Olusturulan SQL sorgusunu veritabaninda calistirir ve sonuc kumesini $result degiskenine atar.

if ($result === false) { //Eger sorgu calistirma hatasi olursa, hata mesajini ekrana yazdirir ve islemi sonlandirir.
    echo"<br>";
    die("Sorgu hatasi: " . $conn->error . "<br>Sorgu: " . $sql);
}


$count = 0;
if ($result->num_rows > 0) {
    // Verileri isleme devam edin

    echo "<table>";

    // Sutun basliklarini yazdirma
    echo "<tr>";
    // Sutun basliklarini al
    $firstRow = $result->fetch_assoc();
    $columns = array_keys($firstRow);
    foreach ($columns as $column) {
        echo "<th>$column</th>";
    }
    echo "</tr>";

    // İlk veriyi isleme kodlarina ekleyin
    $count += 1;
    echo "<tr>";
    foreach ($firstRow as $value) {
        
        echo "<td>$value</td>";
    }
    echo "</tr>";

    // Diger veri setlerini isleme kodlari
    while ($row = $result->fetch_assoc()) {
        $count += 1;
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }

    echo "</table>";

    echo "Toplam Kayit Sayisi: $count";
} else {
    echo "<br>";
    echo "Tabloda veri bulunamadi.";
}

//1

echo "<hr><br><br><br><h1>Şirket Hesap Listesi</h1><br><br>";

$sql =
"SELECT sirket.sirket_ad AS Sirket , banka.banka_ad AS Banka
FROM sirket 
JOIN sirket_hesap 
JOIN banka 
ON sirket.sirket_id = sirket_hesap.sirket_id && banka.banka_id = sirket_hesap.banka_id";
$result = $conn->query($sql);

if ($result === false) {
    echo"<br>";
    die("Sorgu hatasi: " . $conn->error . "<br>Sorgu: " . $sql);
}


$count = 0;
if ($result->num_rows > 0) {
    // Verileri isleme devam edin

    echo "<table>";

    // Sutun basliklarini yazdirma
    echo "<tr>";
    // Sutun basliklarini al
    $firstRow = $result->fetch_assoc();
    $columns = array_keys($firstRow);
    foreach ($columns as $column) {
        echo "<th>$column</th>";
    }
    echo "</tr>";

    // İlk veriyi isleme kodlarina ekleyin
    $count += 1;
    echo "<tr>";
    foreach ($firstRow as $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";

    // Diger veri setlerini isleme kodlari
    while ($row = $result->fetch_assoc()) {
        $count += 1;
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }

    echo "</table>";

    echo "Toplam Kayit Sayisi: $count";
} else {
    echo "<br>";
    echo "Tabloda veri bulunamadi.";
}


//2
echo "<hr><br><br><br><h1>Abonelik  Listesi</h1><br><br>";


$sql = 
"SELECT musteri.musteri_ad AS Musteri , sirket.sirket_ad AS Şirket
FROM musteri 
JOIN abonelik 
JOIN sirket 
ON musteri.musteri_id = abonelik.musteri_id && sirket.sirket_id = abonelik.sirket_id";

$result = $conn->query($sql);

if ($result === false) {
    echo"<br>";
    die("Sorgu hatasi: " . $conn->error . "<br>Sorgu: " . $sql);
}


$count = 0;
if ($result->num_rows > 0) {
    // Verileri isleme devam edin

    echo "<table>";

    // Sutun basliklarini yazdirma
    echo "<tr>";
    // Sutun basliklarini al
    $firstRow = $result->fetch_assoc();
    $columns = array_keys($firstRow);
    foreach ($columns as $column) {
        echo "<th>$column</th>";
    }
    echo "</tr>";

    // İlk veriyi isleme kodlarina ekleyin
    $count += 1;
    echo "<tr>";
    foreach ($firstRow as $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";

    // Diger veri setlerini isleme kodlari
    while ($row = $result->fetch_assoc()) {
        $count += 1;
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo "</tr>";
    }

    echo "</table>";

    echo "Toplam Kayit Sayisi: $count";
} else {
    echo "<br>";
    echo "Tabloda veri bulunamadi.";
}

$conn->close();
?>
