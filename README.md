# BERGARAKO ANTZOKIA — WEB PROIEKTUA

Bergarako antzokiko ekintzen informazioa kontsultatzeko eta sarrerak erosteko webgunearen garapen-dokumentazioa.

---

## AURKIBIDEA

- [1. Sarrera](#1-sarrera)
- [2. Benchmark-a](#2-benchmark-a)
  - [2.1. Ondorioak](#21-ondorioak)
- [3. Erabiltzaile Profila (User Profile)](#3-erabiltzaile-profila-user-profile)
- [4. Krokisa (Wireframes)](#4-krokisa-wireframes)
  - [4.1. Mugikorra](#41-mugikorra)
  - [4.2. Mahaigaina](#42-mahaigaina)
- [5. Nabigazio Mapa](#5-nabigazio-mapa)
- [6. Estilo Gida](#6-estilo-gida)
  - [6.1. Koloreak](#61-koloreak)
  - [6.2. Tipografia](#62-tipografia)
  - [6.3. Ikonoak](#63-ikonoak)
  - [6.4. Botoiak](#64-botoiak)
  - [6.5. Irudiak](#65-irudiak)
- [7. Prototipoa](#7-prototipoa)
- [8. Erabilgarritasunaren Azterketa](#8-erabilgarritasunaren-azterketa)

---

## 1. Sarrera

Bergarako Antzokia udalerriko kultura eta aisialdi eskaintzaren ardatz nagusietako bat da. Proiektu honen helburu nagusia antzokiaren ingurune digitala berritzea da, herritarrei eta bisitariei zerbitzu moderno, azkar eta hurbil bat eskaintzeko asmoz.

* **Testuingurua eta Proiektuaren Jatorria:** Udalerriko kultur ekosistema indartzea eta kudeaketa digitala eguneratzea.
* **Helburu Nagusia:** Bergarako antzokian antolatzen diren kultura-ekitaldi guztiak —hala nola antzerkiak, kontzertuak, proiekzioak eta herri-ekimenak— modu zehatz, erakargarri eta intuitiboan ikusaraztea.
* **Funtzionalitate Nagusia eta Balio Erantsia:** Erabiltzaileak uneoro eguneratuta dagoen agenda bat izango du eskura. Ekitaldien xehetasunak kontsultatzeaz gain, sarrerak linean erosteko eta aukeratutako eserlekuak modu errazean hautatzeko aukera osoa izango du, izapideak azkartuz eta lehiatilan sortzen diren ilarak ekidinez.

---

## 2. Benchmark-a

Bergarako Antzokiko ekitaldiak sarean erakusteko eta sarrerak Internet bidez saltzeko aplikazioa garatu aurretik, inguruko herrietako kultur atarien analisia burutu da, honako iturburuetako informazioan oinarrituta:

- **Arkupe Aretxabaleta** : [https://www.aretxabaleta.eus/es/arkupe/agenda](https://www.aretxabaleta.eus/es/arkupe/agenda)
   - **Ona** : Agenda orokorra erakusten du (antzerkia, kontzertuak, ikastaroak). Hizkuntza aukeraketa (EU/ES) eta bilatzailea ditu. Ordutegiak, helbidea eta harremanetarako bideak oso argi zehazten ditu.
   - **Ahula** : Online sarrera salmenta, kanpoko zerbitzu baten bidez egiten du (aretxabaleta.sacatuentrada.es).  Erosketan ez du xamurtasunik ematen online zerbitzuetan jajoak ez diren erabiltzaileentzat (Adibidez: 65utetik gorako erabiltzaileak).

- **Amaia Antzokia Arrasate** : [https://amaiaarrasate.janto.es/](https://amaiaarrasate.janto.es/)
   - **Ona** : Kategoriak bereizten ditu (cine, cine infantil, musika, teatro, teatro infantil). Ekitaldi bakoitzean data, prezioa (4€, 5€ edo 15€) eta sarrera erosteko botoia ("Comprar") ikusten dira.
   - **Ahula** : Erosketan ez du samurtasunik ematen online zerbitzuetan jajoak ez diren erabiltzaileentzat (Adibidez: 65utetik gorako erabiltzaileak).
     
- **Coliseo Eibar** : [https://www.eibar.eus/es/cultura/coliseo/cartelera-de-cine-en-el-coliseo](https://www.eibar.eus/es/cultura/coliseo/cartelera-de-cine-en-el-coliseo)
   - **Ona** :  Zinemako kartelera, aurretiazko salmenta atala eta "Coliseoaren laguna" txartela kudeatzeko atalak ditu..
   - **Ahula** : Udal atariaren barruan dago. Online sarrera salmenta, kanpoko zerbitzu baten bidez egiten du (https://ticket.kutxabank.es/janto/main.php?idProvincia=20)

- **Elgoibar Herriko Antzokia** : [https://herrikoantzokia.eus/](https://herrikoantzokia.eus/)
   - **Ona** : Egutegi grafikoa du hilabeteko egunekin. Kategoriak bereizten ditu.
  - **Ahula** : Erosketan ez du samurtasunik ematen online zerbitzuetan jajoak ez diren erabiltzaileentzat (Adibidez: 65utetik gorako erabiltzaileak)

### 2.1. Ondorioak

- Webgunera sartu ahal izateko domeinu izen erraza sortu.
- Webguneak elebitasuna izango du ardatz (eu/es).
- Erabiltzaileari erraztasunak eman: Filtroak erabiliko dira ekitaldiak samurrago bilatu ahal izateko.
- Ekitaldi bakoitzean data, prezioa eta informazio garrantzitsua lehen begiradan agertuko da.
- Sarrera erosketa zuzena. Samurtasunak emanaz online zerbitzuetan jajoak ez diren erabiltzaileentzat (silver economi landuaz).
- Webguneko kudeaketari buruz ezin daiteke ondoriorik atera ez bait daukagu beste erreferentziarik. Hala ere, kudeaketa intuitibo eta erraza proposatuko da.

---

## 3. Erabiltzaile Profila (User Profile)

* **Erabiltzaile motak:** Webgunera hurbilduko den publikoa oso anitza da:
  * **Gazteak:** Ingurune digitalean esperientzia handia dutenak eta nabigazio azkarra espero dutenak.
  * **Helduak / Adinekoak:** Teknologiekin harreman txikiagoa dutenak eta interfaze oso argia eta erraza behar dutenak.
* **Funtsezko irizpidea:** Interfazearen erabilgarritasuna (accessibility & usability) ardatz nagusia izango da garapen osoan zehar.
* **Identifikatutako hiru rol nagusiak:**
  1. **Erabiltzaile erregistratua (Arrunta):** Webguneko bolumen nagusia. Ekitaldiak ikusi, txartelak erosi eta bere erosketen historia kudea dezake.
  2. **Gonbidatua:** Erregistratu gabeko bisitaria. Orrialdearen edukia eta agenda ikus ditzake, baina sarrerak erosteko erregistratu edo identifikatu beharko da.
  3. **Administratzailea:** Edukien kudeaketaz, ekitaldi berriak igotzeaz eta sarreren salmenta kontrolatzeaz arduratzen den profila.

---

## 4. Krokisa (Wireframes)

### 4.1. Mugikorra


### 4.2. Mahaigaina

---

## 5. Nabigazio Mapa


---

## 6. Estilo Gida

### 6.1. Koloreak

| Funtzioa | Kolorea | Hex Kodea | Helburua / Aplikazioa |
| :--- | :--- | :---: | :--- |
| **Primary** | Electric Crimson | `#D91B42` | Goiburu nagusiak, ekintza-botoiak (CTA) eta egoera aktiboak. |
| **Secondary** | Deep Ink / Slate | `#0F172A` | Oinarrizko atzealdeak, administrazio-panela eta testu nagusia. |
| **Accent** | Acid Lime / Citron | `#D2F535` | Kategoria-ikurrak, hautatutako eserlekuak eta prezio nabarmenduak. |
| **Background** | Pure Cold White | `#F8FAFC` | Gune publikoko atzealde garbi eta zabala. |
| **Surface** | Pure White (Shadow) | `#FFFFFF` | Ekitaldien txartelak (cards) eta edukiontzi nagusiak. |

### 6.2. Tipografia

Diseinuak bi letra-tipo nagusiren konbinazioa erabiltzen du: Serif klasiko bat izenburu eta kategoria kulturaletarako (dotorezia eta antzerki-izaera emateko) eta Sans-Serif funtzional bat testu gorputz, botoi eta UI osagaietarako.

| Erabilera | Letra-tipoa / Estiloa | Pisua (Weight) | Adibidea eta Ezaugarriak |
| :--- | :--- | :--- | :--- |
| **Izenburu Nagusiak (Hero H1)** | Serif (adib. *Playfair Display* / *Georgia*) | Bold & Italic mix | Izenburu nagusietan hitz gakoak italikoz nabarmentzen dira izaera artistikoa emateko. |
| **Atal Izenburuak (H2 / H3)** | Serif (adib. *Playfair Display* / *Merriweather*) | Bold | `Datozen ekitaldiak` bezalako atal nagusietarako. |
| **Subkategoriak / Tag-ak** | Sans-Serif (adib. *Inter* / *Roboto*) | Bold / Uppercase | Botoietan, txarteletako kategoria-etiketetan (`ANTZERKIA`, `MUSIKA`, `DANTZA`) testu larriz. |
| **Testu Gorputza (Body)** | Sans-Serif (adib. *Inter* / *System UI*) | Regular (400) | Deskribapen eta paragrafo nagusietan irakurgarritasun handia bermatzeko. |
| **Meta-data eta Prezioak** | Sans-Serif | Medium / Bold | Datak, orduak, aretoak eta prezioak (`22,00€`) argi eta garbi erakusteko. |

---

### 6.3. Ikonoak

* **Erabilitako Ikono Nagusiak:**
  * **Egutegia eta Ordua:** Datak (`Urriak 24`) eta ordutegiak (`20:00`) adierazteko hero atalean zein bilatzailean.
  * **Bilaketa:** Lupa ikonoa bilaketa-barran (`Bilatu...`).
  * **Geziak:** Botoietan ekintzaren norabidea adierazteko (`Sarrerak erosi →`).
  * **Ordainketa:** Ordaintzeko moten ikonoak jarriko ditugu (`Visa | Bizum`).
* **Estiloa:** Lerro garbiak, 1.5px - 2px-ko lodiera, testuaren kolore berekoak edo **Primary** (`#D91B42`) / **Accent** (`#D2F535`) koloreetan nabarmenduta.

---

### 6.4. Botoiak

Botoiek hierarkia bisual argia jarraitzen dute, erabiltzailea ekintza nagusira (sarrerak erostea) bideratzeko.

| Botoi Mota | Itxura eta Koloreak (Tabla Ofizialaren Arabera) | Erabilera Interfazean |
| :--- | :--- | :--- |
| **CTA Nagusia** | Atzealdea: **Primary** (`#D91B42`)<br>Testua: Zuria (`#FFFFFF`)<br>Bordeak: Biribildu leunak | Hero ataleko botoi nagusia (`Sarrerak erosi →`) eta formularioetako akzioak (`Filtratu`). |
| **Txartelak** | Atzealdea: **Secondary** (`#0F172A`)<br>Testua: Zuria (`#FFFFFF`)<br>Hover: Akzentuzko argitasuna | Ekitaldi-txartel bakoitzaren barruko botoia (`Sarrerak erosi`). |
| **Header** | Atzealdea: Gardena<br>Bordea: Zuria (`#FFFFFF`)<br>Testua: Zuria | Goiburuko akzioak (`Erregistratu / Saioa`). |
| **Text link** | Atzealdea: Gardena<br>Testua: Zuria / **Primary** | Navigazio simplerako estekak (`Ekitaldiak`). |

---

### 6.5. Irudiak

Webguneko argazkiek eta kartelak garrantzi handia dute ikuskizunak erakargarri egiteko. Irudiak hiru modutan erabiliko dira:

* **Argazki Nagusia (Goiko Bannerra):** Webgunearen goialdean argazki handi eta zabal bat jarriko da ikuskizun nagusia nabarmentzeko. Testua ondo irakurtzeko, argazkiak atzealde iluna izando du.
* **Ekitaldien Argazkiak (Txartelak):** Ekitaldi bakoitzak bere kartel edo argazkia izango du neurri berean, dena ordenatuta ikus dadin.
* **Etiketak Argazkien Gainean:** Argazkien goiko ertzean etiketa txikiak jarriko dira ikuskizun mota adierazteko (adibidez: *Antzerkia*, *Musika*, *Dantza*) edo ekitaldia gomendatua dela nabarmentzeko.


## 7. Prototipoa

[Esteka](https://www.figma.com/make/cSZZR61VIvdkEErPISoQ94/Bergara-Antzoki-Web?p=f&t=oeZJ5F1ilhsOBIHI-0)

---

## 8. Erabilgarritasunaren Azterketa

*(Gehitu hemen erabiltzaile-test zein azterketei buruzko informazioa eta ondorioak)*
