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

### For more info about the project check out the [detailed description](https://github.com/mhdb96/Chernozem/blob/master/ProjectDetails.md)

[Back To The Top](#chernozem)

---

## 🎴 UI Tutorial

### **Müşteri Dashboard**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image009.jpg" width="800"></p>

Proje işlemleri ve kontrol paneli seçeneklerini olduğu ekrandır. Müşterinin proje sayısı, sera sayısı, akit kit sayısı ve pasif kit sayılarını göstermek ve kullanıcının daha önce yaptığı işlemleri bildirim olarak bilgilendirir.

### **Proje Oluştur**

<p align="center"><img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image011.jpg" width="800"></p>

Müşteri yeni proje oluşturması için proje ismi, başlangıç ve bitiş tarihi, paketler, arazinin müşteriye mi ait yoksa kira mı olduğunu ve saha sayısı gibi veriler gereklidir.

<style>
.container {
  position: relative;
  width: 100%;  
}

.container img {
  width: 100%;
  height: auto;
}

a {
      text-decoration: none;
}
.container .btn {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: #555;
  color: white;
  font-size: 16px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
}

.container .btn:hover {
  background-color: black;
}
</style>
<div class="container">
  <img src="https://raw.githubusercontent.com/mhdb96/Chernozem/master/UI%20Tutorial/image009.jpg" alt="Snow" style="width:100%">
  <a class="btn" href="https://github.com/mhdb96/Chernozem/blob/master/UITutorial.md">For the Full UI Tutorial Click Here!</a>
</div>

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
