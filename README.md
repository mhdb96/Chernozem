# Chernozem

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/public/dist/img/logo.png" width="200"></p>

> IOT Smart Farming Platform

---

## Table of Contents

-   [Description](#description)
-   [Özet](#özet)
-   [Problemin Tanımı](#problemin-tanımı)
-   [Neden Böyle Bir Çözüm Sunuyoruz?](#neden-böyle-bir-çözüm-sunuyoruz?)
-   [Çözüm](#çözüm)
-   [Platform Açıklaması](#platform-açıklaması)
-   [Geliştirdiğimiz sistemin mevcut benzer sistemlerden temel farkı nedir?](#geliştirdiğimiz-sistemin-mevcut-benzer-sistemlerden-temel-farkı-nedir?)
-   [Sunacağımız Paketlere Örnekler](#sunacağımız-paketlere-örnekler)
-   [Sunacağımız Kitlere Örnekler](#sunacağımız-kitlere-örnekler)
-   [Senaryo](#senaryo)
-   [Prototip Maliyeti](#prototip-maliyeti)
-   [Veri Tabanı](#author-info)
-   [UI](#author-info)

---

## Description

An Expert System for smart farming which provides the farmers
with best solutions and hardware matching their needs exactly,
with the ability to monitor the hardware remotely through the
website in real-time. The system offers: Admin login; to enter all
the necessary data into the database and User login; which
allows customers to buy the suggested hardware and monitor it.

#### Technologies

-   Laravel
-   JQuery
-   MySQL Server.
-   AdminLTE for UI design.
-   Firebase Realtime Db
-   GitHub for version control.
-   Arduino + NodeMCU

[Back To The Top](#chernozem)

---

## Özet

Chernozem projesi Türkiye’de gerçekleştirilen tarıma destek vermek için geliştirilmiş bir projedir. Bu raporda projenin sahip olduğu ve ileride olacağı temel özelliklerden bahsedilmektedir. Projemiz şimdilik panel ve prototip olmak üzere iki kısımdan oluşmaktadır. Panel kısmı HTML, CSS, PHP dilleri ve Laravel Framework’ü kullanılarak geliştirilmiş bir web uygulamasıdır. Prototip kısmı ise Arduino Uno ve birkaç sensör kullanılarak gerçekleştirilmiştir. Ayrıca veri tabanı olarak da panelde kullanılacak veriler için MySQL, Arduino’nun iletişimi ve verileri işlemesi için kullanacağımız veri tabanını ise FireBase olarak belirledik. Proje ismini ise kara toprak olarak da tanınan, dünyanın en verimli toprağı olan ve ülkemizde de oldukça bulunan toprağın isminin ingilizce karşılığını kullanmak istedik ve sloganımız şöyle ki: “Toprağınız ne olursa olsun teknolojilerimizle Chernozem verimliliğini elde edeceksiniz”.

[Back To The Top](#chernozem)

---

## Problemin Tanımı

Türkiye’de bulunan zengin topraklar ve iklimler ülkemizin tarıma oldukça elverişli olduğunu göstermektedir fakat ülkemizde çiftçilere emeğinin karşılığı tam olarak verilememektedir. Büyük arazilerin kontrolü; zaman ve insan gücü açısından gereksiz harcamalara neden olmuştur. Ayrıca üretimde gerçekleşen su, ilaç ve gübre gibi kaynakların gereksiz ve yanlış kullanımı israfa yol açmaktadır. Durum böyle olunca da köylerde yaşayan genç nüfus emeğinin karşılığını alabilmek için tarımı bırakıp büyük şehirlere göç etmeye başlamıştır ve ülkemiz tarım alanında gerilemiştir.

[Back To The Top](#chernozem)

---

## Neden Böyle Bir Çözüm Sunuyoruz?

Ülke genelinde teknolojinin yaygınlaşması böyle bir projenin garipsenmeyeceği, kullanılmak isteneceği ve kolaylıkla kullanılabileceği bir dönem yaratmıştır.

IOT ekosisteminin genişlemesi, dünya genelinde IOT bilinirliğinin artması ve bu alanda gün geçtikçe sayısı artmaya devam eden büyük projelerin geliştirilmesi, projemizin olabilirliğini arttırmıştır.

[Back To The Top](#chernozem)

---

## Çözüm

Projemiz tarımda üretilecek olan bitkilerin kontrolünü yapmaktadır. Ülkemiz tarım açısından oldukça zengin olmasından dolayı bu projemizi bir prototip olarak geliştirmek yerine ülkenin her bölgesine uyabilecek dinamik bir yapı geliştirdik. Hazırladığımız panel sayesinde kullanıcılar tarım yapacakları alanları belirleyerek kullanması gerekecek olan kitleri kullanıcılara sunuyoruz. Kullanıcılar önerdiğimiz kitlere ek olarak kendileri de istedikleri kitleri paketlerine ekleyebilirler.
Kullanıcılar paketlere karar verip satın aldıktan sonra kurulum aşamasını gerçekleştiriyoruz. Kurulumu tamamladıktan sonra ekilen bitkilerde ve arazide ısı, nem, kamera, toprak gibi sensörler işlenerek çıkan değerlere göre havalandırma, ilaçlama, sulama, gübreleme gibi eylemler gerçekleştirilir. Bu sayede çiftçiye daha az iş düşmektedir ve çiftçi zaman ve güç açısından tasarruf edebilmektedir.

[Back To The Top](#chernozem)

---

## Platform Açıklaması

### **PAKET**

Oluşturulmuş paketleri gösterildiği bölümdür. Paketler bitkiye göre belirlenmektedir. Paket bünyesinde isim, toprak, bitki, iklim, saha barındırır.

#### **Paket İşlemleri**

Paketlerin oluşturulduğu güncelleme, silme ve listeleme yapıldığı kısımdır. Bu bölümde paket ismi, toprak, bitki, iklim, saha işlemleri listelenir.

#### **Paketlere Kit Ekle**

Kitlerimiz bölümde oluşturduğumuz kitlerden uygun olanları gerekli sayıda eklendiği bölümdür ayrıca paketteki var olan kiti de buradan silebiliriz.

#### **Toprak İşlemleri**

Paketlerde toprak değeri eklenmektedir. Bu toprakların isimlerinin ve verimliklerinin eklendiği, silindiği veya var olan toprağın güncellendiği bölümdür.

#### **İklim İşlemleri**

Paketlerde iklim değeri eklenmektedir. İklimler eklenirken hangi toprakları barındırdığı da eklenmelidir. Bu bölümde iklime ekleme, silme, güncelleme ve listeleme işlemeleri yapılmaktadır.

#### **Bitki İşlemleri**

Bitki türlerinin eklendiği, güncellendiği, silindiği ve listelendiği bölümdür. Bu bölümde bitkinin ismi, fiyatı, tipi (sebze mi meyve mi), birimi (sahaya fidan veya tohum olarak mı eklenicek) ve hangi iklimin toprağında ekildiğini gösterir.

#### **Saha İşlemleri**

Saha ekleme, silme, güncelleme ve listeleme yapıldığı bölümdür. Bu bölümde var olan sahalarımız, fiyat (kiralama veya satın alma), saha tipi ve birimi (metre kare, dönüm vs.) vardır.

#### **Saha Kapasite İşlemleri**

Saha kapasitesinin ekleme, silme, güncelleme ve listeleme işlemlerinin yapıldığı bölümdür. Burada seçilen sahada bitki türüne göre ne kadar tohum veya fidan eklenmesi gerektiğini gösterir.

### **KİT**

Sensor, eylem, eyleyici, kontrol gibi yapıları bünyesinde barındıran elektronik bir bileşendir. Pakete göre düzenlenmektedir. Her pakette bir veya daha fazla kit olabilir.

#### Kit İşlemleri

Sera için uygun sensor, eyleyici, kontrolör seçilip kitin oluşturulduğu kısımdır. Bu bölümde kit ekleme, güncelleme, silme ve listeleme işlemi yapılmaktadır. Listelenen kitlerin ismi, açıklma, sensorler, eyleyiciler ve kontrolör gösterilmektedir.

#### Giriş İşlemleri

Seradan bilgi almak istediğimiz birimlerin ekleme, güncelleme, silme işlemlerinin yapıldığı bölümdür. Bu bölümde işlem yapılacak birimler sıcaklık, toprak nemi, gaz, hareket, su seviyesi ve nemdir.

#### Eylem İşlemleri

Serada meydana yapılması istenen eylemlerin ekleme, güncelleme, silme işlemlerinin yapıldığı bölümdür. Serada yapılabilecek eylemlere örnek; alarm, sulama, fan çalıştırma.

#### Sensor İşlemleri

Serada kullanılan sensorleri kullanıcını isteğine göre ekleme var olan sensorleri ise silme ve güncelleme işleminin yapılığı bölümdür. Listelenen sensorlerin isim, açıklama, fiyat, hangi verileri getirdiğini gösterilir.

#### Eyleyici İşlemleri

Serada pakete belirtilen eylemlere göre gerçekleştiren bileşenlerin bulunduğu bölümdür. Bu bölümde eyleyici ekleme, silme, güncelleme ve listeleme işlemleri yapılır. Listelenen eyleyicilerin ismi, açıklama, fiyat, gerçekleştirdiği eylem belirtilmektedir.

#### Kontrolör İşlemleri

Serada kullanılan kontrolör ekleme, silme, güncelleme ve listeleme işleminin yapıldığı kısımdır. Listelene kontrolörün isim, açıklama ve fiyat bilgisi verilmektedir.

[Back To The Top](#chernozem)

---

## Geliştirdiğimiz sistemin mevcut benzer sistemlerden temel farkı nedir?

Ülkemizin zengin toprak ve iklim çeşitleri nedeniyle tarıma çok değer vermektedir. Teknolojinin de ilerlemesiyle birlikte biz de tarımı akıllı hale getirip hem çiftçi hem de mahsuller açısından verimli olmasını istiyoruz. Bizim geliştirdiğimiz bu projenin diğer akıllı tarım uygulamalarından en büyük farkı çiftçiye düşen işi hafifletmek ve kolay kullanım sağlamaktır. Temel akıllı tarım sistemlerinde genellikle amacı: hazır sensörler ve kontrolör yardımıyla sıcaklık nem gibi tarım için gerekli olan faktörleri güncel olarak çiftçiye iletmektir. Fakat bizim projemizde tarım alanında karşılaşılan sorunların otomatik olarak çözülmesi ve kullanıcı paneli sayesinde çiftçiye kolay kullanımın sağlanması bizi diğer akıllı tarım uygulamalarından ayıran en önemli etkenlerdir. Çoğu IOT projesinde bulunan ve bizim projemizde de çözülemeyen olumsuz etken güvenliktir. Bu açıdan güvenlik, fiziksel olarak taşınabilir bir Iot cihazının çalınması ya da değişiklik yapılması, mevcut bir iot sistemine yönelik hizmet engelleyen DoS saldırıları gibi faaliyetler kullanılan iot projesini olumsuz etkilemektedir.

[Back To The Top](#chernozem)

---

## Sunacağımız Paketlere Örnekler

| Paket Adı            | Toprak Tipi     | Bitki         | İklim                            | Saha       |
| -------------------- | --------------- | ------------- | -------------------------------- | ---------- |
| Kivi paketi          | Orman Toprağı   | Kivi          | Marmara İklimi                   | Açık Arazi |
| Sırık Domates paketi | Akdeniz Toprağı | Sırık Domates | Akdeniz İklimi                   | Sera       |
| Karpuz Paketi        | Kireçli Toprak  | Karpuz        | Güneydoğu Anadolu Karasal İklimi | Sera       |
| Lavanta Paketi       | Kireçli Toprak  | Lavanta       | Akdeniz İklimi                   | Sera       |
| Zeytin paketi        | Kumlu Toprak    | Zeytin        | Akdeniz İklimi                   | Açık Arazi |

[Back To The Top](#chernozem)

---

## Sunacağımız Kitlere Örnekler

| Kit Adı             | Sensörler                                              | Eyleyiciler                         | Kontrolör   |
| ------------------- | ------------------------------------------------------ | ----------------------------------- | ----------- |
| Sera Kontol Sistemi | Sıcak ve Nem<br>Toprak Nemi<br>Hareket Algılama<br>Gaz | Fan<br>SuPompası<br>Alarm<br>Isıtma | Arduino Uno |
| Güvenlik Kiti       | Hareket Algılama<br>Gaz                                | Alarm                               | Arduino Uno |
| Sulama Kiti         | Toprak Nemi                                            | Su Pombası                          | Arduino Uno |
| Hava Durumu Kiti    | Sıcaklık ve Nem                                        | Isıtma<br>Fan                       | Arduino Uno |

[Back To The Top](#chernozem)

---

## Senaryo

Bitki: Sırık Domates

Toprak Tipi: Kara toprak

Tarım Tipi: Sera

İklim: Marmara Bölgesi

Mevsim: Sonbahar

Sıcaklık hata payı: 2 derece

Nem hata payı: Yüzde 5

### **Sıcaklık**

Sera sıcaklığı -2 derecenin altına düştüğün de bitki ölür, 13 derecenin altında olgunlaşması yavaşlar, en optimum gelişimini 24 derecedir. Seradan DHT11 sensör ile 5 saniyede bir hava sıcaklığı alınır. Sıcaklığın 13 derecenin altına düştüğün de sensör uyarı verir ve ısıtıcı sistem tarafından çalıştırılır. Sıcaklık 35 derece üzerine çıktığında yapraklarda kuruma ve üründe yanmalar başlıyor. 35 derece üzerine çıktığında fan sistem tarafından çalıştırılır.

### **Nem**

Nem sıcaklığı DHT11 ile 2 saniyede bir ölçülür. Sensörden gelen nem değeri yüzdelik olarak alınır. Nem oranı yüzdelik olarak 60 altına düşmemesi gerekir en yüksek nem değeri ise 90 geçmemelidir. Nem sınırı aşıldığında sistem fanı çalıştırır. Düşük nem değerinde ise su püskürtme ile hava nemlendirilir.

### **Toprak Nemi**

Toprak nemi değeri yüzdelik olarak 70 ile 90 arasında olmalıdır. Toprak nem sensörü 0 ile 1023 arasında değer döndürür. Nem yüzde 90 yani sensörden 920 değeri ölçülürse nem fazla olduğunda hava sıcaklığı 35 derece altında ise ıstıcı çalıştırılır ancak sıcaklık yüksek ise fan çalıştırılarak nem oranı düşürülür. Nem yüzde 70 yani sensörden 715 değeri ölçüldüğünde nem düşük olduğunda su pompası devreye girerek damla sulama ile nem oranını arttırılır.

### **Fidanlanma**

Domates tohumunun çimlenme süresi;
10 derecede çimlenme 43 gün,
15 derecede çimlenme 14 gün,
20 derecede çimlenme 8 gün,
25 derecede çimlenme 6 gün sürmektedir.

### **Hareket**

Seraya hırsız veya yabani hayvan girmesini HC SR501 sensörü ile 3 – 7 metre mesafe aralığında tespit edip HIGH değerini döndürür ve sistem otomatik olarak alarm çalıştırıp uyarı mesajı gönderir.

### **Yangın**

Yangın durumunda havadaki CO veya duman ölçümü yaparak tespit edip sistem mesaj gönderir. CO veya duman MQ-4 sensörü 0 ile 1023 aralığında değer döndürür. Normal koşullarda sensör 30 değerini döndürürken 100 değerinde kritik seviyeye gelir. Sistem 100 değerinden sonra uyarı mesajı gönderir.

### **Hasat**

Sera da yetiştirilen domatesin hasat süresi ortalama olarak 4 ay sürmektedir. Bu süre gübre, sıcaklı, sulama miktarı vs. özelliklere göre farklılık göstermektedir.

[Back To The Top](#chernozem)

---

## Prototip Maliyeti

-   Arduino Uno 25TL
-   NodeMCU 30TL
-   Toprak Nemi Sensörü 10TL
-   DHT11 Sıcaklık ve Nem Sensörü 10TL
-   MQ4 Gaz Sensörü 10TL
-   Hareket Sensörü 10TL
-   Su Seviyesi Sensörü 5TL
-   Fan 12TL
-   Su Pompası 45 TL
-   2 Kanallı Röle 15TL
-   Jumber Kablo + 2 LED 10TL
-   Breadboard 10TL
-   Sera Malzemeleri 15TL

Toplam = 207 TL

[Back To The Top](#chernozem)

---

## 🎴 Müşteri Arayüzü

### **Müşteri Dashboard**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image009.jpg" width="800"></p>

Proje işlemleri ve kontrol paneli seçeneklerini olduğu ekrandır. Müşterinin proje sayısı, sera sayısı, akit kit sayısı ve pasif kit sayılarını göstermek ve kullanıcının daha önce yaptığı işlemleri bildirim olarak bilgilendirir.

### **Proje Oluştur**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image011.jpg" width="800"></p>

Müşteri yeni proje oluşturması için proje ismi, başlangıç ve bitiş tarihi, paketler, arazinin müşteriye mi ait yoksa kira mı olduğunu ve saha sayısı gibi veriler gereklidir.

### **Doğu Yakası Seraları**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image013.jpg" width="800"></p>

Müşterini doğu yakasındaki seralarını listeler.

### **Örnek Sera-A**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image015.jpg" width="800"></p>

Seralarda herhangi birini seçince var olan kitleri listeler.

### **Örnek Sera-A da ki Sera Kiti**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image017.jpg" width="800"></p>

Seçilen kitte daha önce seçilmiş veriler listelenmiştir. Ayrıca kit işlemleri nasıl kullanılacağına dair müşteriye uyarılar verilmiştir.

### **Sıcaklık Verisi**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image019.jpg" width="800"></p>

Seçilmiş seradan her 5 saniyede bir sıcaklık değerleri grafikte gösterilmiştir.

### **Nem Verisi**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image021.jpg" width="800"></p>

Seçilmiş seradan her 5 saniyede bir nem değerleri grafikte gösterilmiştir.

### **Toprak Nemi Verisi**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image023.jpg" width="800"></p>

Seçilmiş seradan her 5 saniyede bir toprak nemi değerleri grafikte gösterilmiştir.

### **Hareket Verisi**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image025.jpg" width="800"></p>

Seçilmiş seradan her 5 saniyede bir hareket değerleri grafikte gösterilmiştir.

### **Gaz verisi**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image027.jpg" width="800"></p>

Seçilmiş seradan her 5 saniyede bir gaz değerleri grafikte gösterilmiştir.

[Back To The Top](#chernozem)

---

## 🎴 Admin Arayüzü

### **Admin Dashboard**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image029.jpg" width="800"></p>
<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image031.jpg" width="800"></p>

Adminin kontrol paneli, paketlerimiz, kitlerimiz, diğer seçeneklerinin olduğu ekrandır. Var olan proje sayısı, sistemi kullanan müşteri sayısı, oluşturulan kit sayısı ve oluşturulan paket sayıları belirtilmiştir. Ayrıca aylık sisteme katılan müşteri sayısı ile oluşturulan proje sayısı grafikle gösterilmiştir.

### **Paket İşlemleri Listeleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image033.jpg" width="800"></p>

Daha önce eklenmiş veya yeni eklenen paket türlerinin isim, iklim, toprak, bitki ve saha özellikleri bu sayfadan görüntülenebilir. Ayrıca ilgili paketin güncelleme ve silme işlemi bu sayfadan kontrol edilmektedir. Yeni bir saha türü eklemek için "Yeni Ekle" butonuna basılması gerekmektedir.

### **Paket İşlemleri Ekleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image035.jpg" width="800"></p>

"Yeni Ekle" butonuna bastıktan sonra yeni paket türü eklemek için isim, ardından sırası ile iklim, toprak, bitki ve saha bilgileri seçilmelidir. "Ekle" yazan mavi butona tıklayarak yeni paket türü eklenmiş olur.

### **Paket Kitleri İşlemleri Listeleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image037.jpg" width="800"></p>

Daha önce eklenmiş veya yeni eklenen paketlerin isim, kitleri ve bu kitlerden kaç tane oldukları bu sayfadan görüntülenebilir. Ayrıca ilgili paket kitlerinin ekleme ve silme işlemi bu sayfadan kontrol edilmektedir. Pakete yeni kitler eklemek için "Artı" butonuna basılması gerekmektedir.

### **Paket Kitleri İşlemleri Ekleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image039.jpg" width="800"></p>

"Artı" butonuna bastıktan sonra açılan sayfa üzerinde "Kitleri Seçin" yazan yere tıkladıktan sonra seçilebilecek kitler üzerinden bir seçim yapılmalıdır. Ayrıca kit seçimleri yaptıktan sonra kit içerisinde bulunan sensörlerin limit değerleri de yazılmalıdır. "Ekle" yazan mavi butona tıklayarak ilgili pakete belirlenen kitler eklenmiş olur.

### **Toprak İşlemleri Listeleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image041.jpg" width="800"></p>

Daha önce eklenmiş veya yeni eklenen toprak türlerinin isim ve verimlilik özellikleri bu sayfadan görüntülenebilir. Ayrıca ilgili toprağın güncelleme ve silme işlemi bu sayfadan kontrol edilmektedir. Yeni bir toprak türü eklemek için "Yeni Ekle" butonuna basılması gerekmektedir.

### **Toprak İşlemleri Ekleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image043.jpg" width="800"></p>

"Yeni Ekle" butonuna bastıktan sonra yeni toprak türü eklemek için toprağın isim ve verimlilik özellikleri girilmelidir. Ayrıca birden fazla toprak türü girilecekse "Ekle" yazan yeşil butona tıklayarak veri giriş sayısı arttırılabilir. "Ekle" yazan mavi butona tıklayarak yeni toprak türü eklenmiş olur.

### **İklim İşlemleri Listeleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image045.jpg" width="800"></p>

Daha önce eklenmiş veya yeni eklenen iklim türlerinin isim ve bu iklime bağlı toprak türleri bu sayfadan görüntülenebilir. Ayrıca ilgili paketin güncelleme ve silme işlemi bu sayfadan kontrol edilmektedir. Yeni bir paket türü eklemek için "Yeni Ekle" butonuna basılması gerekmektedir.

### **İklim İşlemleri Ekleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image047.jpg" width="800"></p>

"Yeni Ekle" butonuna bastıktan sonra yeni iklim türü eklemek için isim ve toprak türleri seçilmelidir. "Ekle" yazan mavi butona tıklayarak yeni iklim türü eklenmiş olur.

### **Bitki İşlemleri Listeleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image049.jpg" width="800"></p>

Daha önce eklenmiş veya yeni eklenen bitki türlerinin isim, fiyat, tür, birim ve hangi iklim hangi toprakta yetiştiği bu sayfadan görüntülenebilir. Ayrıca ilgili bitkinin güncelleme ve silme işlemi bu sayfadan kontrol edilmektedir. Yeni bir bitki türü eklemek için "Yeni Ekle" butonuna basılması gerekmektedir.

### **Bitki İşlemleri Ekleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image051.jpg" width="800"></p>

"Yeni Ekle" butonuna bastıktan sonra yeni bitki türü eklemek için isim, fiyat, bitki türü, ölçü türü ve hangi iklim hangi topraklarda yetiştiği seçilmelidir. "Ekle" yazan mavi butona tıklayarak yeni bitki türü eklenmiş olur.

### **Saha İşlemleri Listeleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image053.jpg" width="800"></p>

Daha önce eklenmiş veya yeni eklenen saha türlerinin isim, fiyat, tür ve birim özellikleri bu sayfadan görüntülenebilir. Ayrıca ilgili sahanın güncelleme ve silme işlemi bu sayfadan kontrol edilmektedir. Yeni bir saha türü eklemek için "Yeni Ekle" butonuna basılması gerekmektedir.

### **Saha İşlemleri Ekleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image055.jpg" width="800"></p>

"Yeni Ekle" butonuna bastıktan sonra yeni saha türü eklemek için isim, fiyat, saha türü ve birim (Metrekare, donum vb.) özellikleri girilmelidir. "Ekle" yazan mavi butona tıklayarak yeni saha türü eklenmiş olur.

### **Saha Kapasite İşlemleri Listeleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image057.jpg" width="800"></p>

Daha önce eklenmiş veya yeni eklenen saha kapasite türlerinin saha, bitki ve kapasite özellikleri bu sayfadan görüntülenebilir. Ayrıca ilgili saha kapasitesinin güncelleme ve silme işlemi bu sayfadan kontrol edilmektedir. Yeni bir saha kapasite türü eklemek için "Yeni Ekle" butonuna basılması gerekmektedir.

### **Saha Kapasite İşlemleri Ekleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image059.jpg" width="800"></p>

"Yeni Ekle" butonuna bastıktan sonra yeni saha kapasite türü eklemek için saha türü, bitki türü ve kapasite özellikleri girilmelidir. "Ekle" yazan mavi butona tıklayarak yeni saha kapasite türü eklenmiş olur.

### **Kit İşlemleri Listeleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image061.jpg" width="800"></p>

Admin tarafından oluşturulmuş kitleri listeler. Listelenen kitlerde silme, güncelleme ve ekleme işlemleri yapılabilmektedir.

### **Kit İşlemleri Ekleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image063.jpg" width="800"></p>

Admin tarafından kit ekleme işlemi yapılır. Kit oluşturulurken isim, gerekli açıklama, sensor türleri, eyleyici türleri ve kontrolörler türlerindeki veriler girilmelidir.

### **Giriş İşlemleri Listeleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image065.jpg" width="800"></p>

Admin tarafından seradan alınması istenen girişleri listeler. Listelenen girişlerde silme, güncelleme ve ekleme işlemleri yapılabilmektedir.

### **Giriş İşlemleri Ekleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image067.jpg" width="800"></p>

Admin tarafından kit ekleme işlemi yapılır. Giriş oluşturulurken isim ve firebase kodu türlerindeki veriler girilmelidir.

### **Eylem İşlemleri Listeleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image069.jpg" width="800"></p>

Admin tarafından oluşturulmuş sera eylemlerini listeler. Listelenen eylemlerde silme, güncelleme ve ekleme işlemleri yapılabilmektedir.

### **Eylem İşlemleri Ekleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image071.jpg" width="800"></p>

Admin tarafından eylem ekleme işlemi yapılır. Eylem oluşturulurken isim ve firebase kodu türlerindeki veriler girilmelidir.

### **Sensör İşlemleri Listeleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image073.jpg" width="800"></p>

Admin tarafından oluşturulmuş sensörleri listeler. Listelenen sensörlerde silme, güncelleme ve ekleme işlemleri yapılabilmektedir.

### **Sensör İşlemleri Ekleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image075.jpg" width="800"></p>

Admin tarafından sensör ekleme işlemi yapılır. Sensör oluşturulurken isim, gerekli açıklama, fiyat ve giriş türlerindeki veriler girilmelidir.

### **Eyleyici İşlemleri Listeleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image077.jpg" width="800"></p>

Admin tarafından oluşturulmuş eyleyicileri listeler. Listelenen eyleyicilerde silme, güncelleme ve ekleme işlemleri yapılabilmektedir.

### **Eyleyici İşlemleri Ekleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image079.jpg" width="800"></p>

Admin tarafından eyleyici ekleme işlemi yapılır. Eyleyici oluşturulurken isim, gerekli açıklama, fiyat ve eyleyici türlerindeki veriler girilmelidir.

### **Kontrolör İşlemleri Listeleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image081.jpg" width="800"></p>

Admin tarafından oluşturulmuş kontrolörleri listeler. Listelenen kontrolörlerde silme, güncelleme ve ekleme işlemleri yapılabilmektedir.

### **Kontrolör İşlemleri Ekleme**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image083.jpg" width="800"></p>

Admin tarafından kontrolör ekleme işlemi yapılır. Kontrolör oluşturulurken isim, gerekli açıklama ve fiyat türlerindeki veriler girilmelidir.

### **Kategori İşlemleri**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image085.jpg" width="800"></p>

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image087.jpg" width="800"></p>

Admin tarafından oluşturulmuş kategori türlerini listeler. Listelenen kategori türlerini silme, güncelleme ve ekleme işlemleri yapılabilmektedir. Ekleme işleminde yeni kategori türü eklenmektedir.

### **Tip İşlemleri**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image089.jpg" width="800"></p>

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image091.jpg" width="800"></p>

Admin tarafından oluşturulmuş tip isimleri ve kategorilerini listeler. Listelenen tip türlerini silme, güncelleme ve ekleme işlemleri yapılabilmektedir. Ekleme işleminde yeni tipin ismi ve kategori türü eklenmektedir.

### **Birim İşlemleri**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image093.jpg" width="800"></p>

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image095.jpg" width="800"></p>

Admin tarafından oluşturulmuş birimler ve tipleri listeler. Listelenen birimleri silme, güncelleme ve ekleme işlemleri yapılabilmektedir. Ekleme işleminde yeni birimin ismi ve tip türü eklenmektedir.

### **Mac İşlemleri**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image097.jpg" width="800"></p>

Müşterinin aktif olmayan kitleri listelenmektedir. Kitlerin aktif olması için adminin Mac adresi eklemesi gerekmektedir.

[Back To The Top](#chernozem)

---

## 🙌 Prototype Circuit Design

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image099.png" width="800"></p>

[Back To The Top](#chernozem)

---

## 🙌 Prototype Photos

### **Overview**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image101.jpg" width="800"></p>

### **Controllers**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image103.jpg" width="800"></p>

### **Actuaors**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image105.jpg" width="800"></p>

### **Cable Management**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image107.jpg" width="800"></p>

[Back To The Top](#chernozem)

---

## 🙌 Developers' Info

-   **Muhammed Bedavi** ~ [Linkedin 🔗](https://www.linkedin.com/in/mhdb96/) - [GitHub 🔗](https://github.com/mhdb96)
-   **Talha AYDIN** ~ [Linkedin 🔗](https://www.linkedin.com/in/talha-aydin/) - [GitHub 🔗](https://github.com/talhaaydn)
-   **Onur KANTAR** ~ [Linkedin 🔗](https://www.linkedin.com/in/onur-kantar-580ab1ab/) - [GitHub 🔗](https://github.com/simiyen)

[Back To The Top](#chernozem)
