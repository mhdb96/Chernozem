# Senaryo

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

Domates tohumunun çimlenme süresi; 10 derecede çimlenme 43 gün, 15 derecede çimlenme 14 gün, 20 derecede çimlenme 8 gün, 25 derecede çimlenme 6 gün sürmektedir.

### **Hareket**

Seraya hırsız veya yabani hayvan girmesini HC SR501 sensörü ile 3 – 7 metre mesafe aralığında tespit edip HIGH değerini döndürür ve sistem otomatik olarak alarm çalıştırıp uyarı mesajı gönderir.

### **Yangın**

Yangın durumunda havadaki CO veya duman ölçümü yaparak tespit edip sistem mesaj gönderir. CO veya duman MQ-4 sensörü 0 ile 1023 aralığında değer döndürür. Normal koşullarda sensör 30 değerini döndürürken 100 değerinde kritik seviyeye gelir. Sistem 100 değerinden sonra uyarı mesajı gönderir.

### **Hasat**

Sera da yetiştirilen domatesin hasat süresi ortalama olarak 4 ay sürmektedir. Bu süre gübre, sıcaklı, sulama miktarı vs. özelliklere göre farklılık göstermektedir.

