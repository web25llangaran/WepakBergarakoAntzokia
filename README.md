# BERGARAKO ANTZOKIA — WEB PROIEKTUA

Errepositorio honetan, Bergarako Antzokiko ekitaldiak sarean erakusteko eta sarrerak Internet bidez saltzeko webgune baten sorrera landuko da. Honen kudeaketa barne hartuz.


<br>

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
- [8. Edukien lizentzia](#8-edukien-lizentzia)
- [9. Erabilgarritasunaren azterketa](#9-erabilgarritasunaren-azterketa)
- [10. Bibliografia eta webgrafia](#10-bibliografia-eta-webgrafia)

<br>

## 1. Sarrera

Bergarako Antzokia udalerriko kultura eta aisialdi eskaintzaren ardatz nagusietako bat da. Proiektu honen helburu nagusia antzokiaren ingurune digitala berritzea da, herritarrei eta bisitariei zerbitzu moderno, azkar eta hurbil bat eskaintzeko asmoz.

* **Testuingurua eta Proiektuaren Jatorria:** Udalerriko kultur ekosistema indartzea eta kudeaketa digitala eguneratzea.
* **Helburu Nagusia:** Bergarako antzokian antolatzen diren kultura-ekitaldi guztiak —hala nola antzerkiak, kontzertuak, proiekzioak eta herri-ekimenak— modu zehatz, erakargarri eta intuitiboan ikusaraztea.
* **Funtzionalitate Nagusia eta Balio Erantsia:** Erabiltzaileak uneoro eguneratuta dagoen agenda bat izango du eskura. Ekitaldien xehetasunak kontsultatzeaz gain, sarrerak online erosteko eta aukeratutako eserlekuak modu errazean hautatzeko aukera osoa izango du, izapideak azkartuz eta lehiatilan sortzen diren ilarak ekidinez.

<br>

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
   - **Ahula** : Udal atariaren barruan dago. Online sarrera salmenta, kanpoko zerbitzu baten bidez egiten du: ticket.kutxabank.es/janto...

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

<br>

## 3. Erabiltzaile Profila (User Profile)

* **Erabiltzaile motak:** Webgunera hurbilduko den publikoa oso anitza da:
  * **Gazteak:** Ingurune digitalean esperientzia handia dutenak eta nabigazio azkarra espero dutenak.
  * **Helduak / Adinekoak:** Teknologiekin harreman txikiagoa dutenak eta interfaze oso argia eta erraza behar dutenak.
* **Funtsezko irizpidea:** Interfazearen erabilgarritasuna (accessibility & usability) ardatz nagusia izango da garapen osoan zehar.
* **Identifikatutako hiru rol nagusiak:**
  * **Erabiltzaile erregistratua (Arrunta):** Webguneko bolumen nagusia. Ekitaldiak ikusi, txartelak erosi eta bere erosketen historia kudea dezake.
  * **Gonbidatua:** Erregistratu gabeko bisitaria. Orrialdearen edukia eta agenda ikus ditzake, baina sarrerak erosteko erregistratu edo identifikatu beharko da.
  * **Administratzailea:** Edukien, ekitaldien eta sarreren kudeaketaz arduratzen den profila.

<br>

## 4. Krokisa (Wireframes)

Webguneko krokisa burutzean **Mobile first** kontuan izan da, hau orrialdea batez ere mugikorretatik erabiliko delako da.
Webgunea ahalik eta bakunena eta ulertzeko errazena burutuko da, adin guztietako jendearentzat eskuragarri egon dadin.

### 4.1. Mugikorra

![Mobile prototipo](diseinua/img/MugikorraBozetoa.jpeg)

### 4.2. Mahaigaina

![Mahaigaina prototipoa](diseinua/img/OrdenagailuBozetoa.jpeg)

<br>

## 5. Nabigazio Mapa

![Nabigazio mapa](diseinua/img/NabigazioMapa.jpeg)

<br>

## 6. Estilo Gida

### 6.1. Koloreak

Antzokiko batetako webgunerako, koloreen paletak, grina, sormena, kultura jasoa eta gertukoa transmititu nahi ditu.
Hau kontuan izanik, kolore bat esleitzeko, gida honek gaiari lotutako ondorengo kolore-paleta proposatzen du: 

| Funtzioa | Kolorea | Hex Kodea | Helburua / Aplikazioa |
| :--- | :--- | :---: | :--- |
| **Primary** | Granatea | #7A1C2C | Goiburu nagusiak, ekintza-botoiak (CTA) eta egoera aktiboak. |
| **Secondary** | Ikatz-granate iluna  | #260F10 | Oinarrizko atzealdeak, administrazio-panela. |
| **Accent** | Urre Zaharra | #D4AF37 | Kategoria-ikurrak, hautatutako eserlekuak eta prezio nabarmenduak. |
| **Background** | Grisa, Zuri hautsia | #F9F9FB| Gune publikoko atzealde garbi eta zabala. |
| **Testua eta egitura** | Ikatz-granate iluna  | #260F10  | Irakurgarritasun handia, beltz puruaren kontraste gogorrik gabe |

Granatea da kolore nagusia, eta antzokiaren irudi tradizionala dakar gogora. Berotasuna, grina eta sormena transmititzen ditu, eta, gorri biziak ez bezala, serio eta dotore sentitzen da.

Ikatz-granate iluna, ia beltza da, baina marroi-gorrixka apur batekin, beltz hutsa baino beroagoa, argiak itzali eta ikuskizuna hasi baino lehenagokoa. Testurako ere ona da, irakurgarritasun handia ematen baitu zuriaren gainean.

Zuri hautsia, atzeko plano gisa lasaitasuna eta garbitasuna ematen ditu. Beste koloreei arnasa eman eta webgunea ez da horren astuna egiten, nahiz eta kolore ilun asko erabili.

Urre zaharra, distira eta ospakizunari lotua.Iikuskizunaren "estreinaldia", sarrerak eta ekitaldi bereziak. Ez da gehiegi erabiliko, bitxikeria edo luxu itxura hartuko bait luke, eta herriko antzoki bat gertukoa izan behar da.

More iluna,  multzoko kolore "zaratatsuena" da. Sormena, misterioa eta ikuskizunaren fantasia transmititzen ditu, eta webgunea tradizionalegi geratzea saihesten du. Granatearekin eta urrearekin batera erabilita, antzoki-giro klasiko hori eguneratzen du, eta gazteagoentzat erakargarriagoa egiten du. 

![Kolore paleta](diseinua/img/BergarakoAntzokiaKOLOREAK.jpg)

![Kolore paleta Realtimes Colors ](diseinua/img/EstiloGidaKoloreak.png)

### 6.2. Tipografia

Diseinuak bi letra-tipo nagusiren konbinazioa erabiltzen du: Playfair Display  klasiko bat izenburu eta kategoria kulturaletarako (dotorezia eta antzerki-izaera emateko) eta Clarity City funtzional bat testu gorputz, botoi eta UI osagaietarako.

| Erabilera | Letra-tipoa / Estiloa | Pisua (Weight) | Adibidea eta Ezaugarriak |
| :--- | :--- | :--- | :--- |
| **Izenburu Nagusiak (Hero H1)** | Playfair Display | Bold & Italic mix | Izenburu nagusietan hitz gakoak italikoz nabarmentzen dira izaera artistikoa emateko. |
| **Atal Izenburuak (H2 / H3)** | Playfair Display | Bold | `Datozen ekitaldiak` bezalako atal nagusietarako. |
| **Subkategoriak / Tag-ak** | Clarity City | Bold / Uppercase | Botoietan, txarteletako kategoria-etiketetan (`ANTZERKIA`, `MUSIKA`, `DANTZA`) testu larriz. |
| **Testu Gorputza (Body)** | Clarity City | Regular (400) | Deskribapen eta paragrafo nagusietan irakurgarritasun handia bermatzeko. |
| **Meta-data eta Prezioak** | Clarity City | Medium / Bold | Datak, orduak, aretoak eta prezioak (`22,00€`) argi eta garbi erakusteko. |


### 6.3. Ikonoak

* **Erabilitako Ikono Nagusiak:**
  * **Egutegia eta Ordua:** Datak (`Urriak 24`) eta ordutegiak (`20:00`) adierazteko hero atalean zein bilatzailean.
  * **Bilaketa:** Lupa ikonoa bilaketa-barran (`Bilatu...`).
  * **Geziak:** Botoietan ekintzaren norabidea adierazteko (`Sarrerak erosi →`).
  * **Ordainketa:** Ordaintzeko moten ikonoak jarriko ditugu (`Visa | Bizum`).
* **Estiloa:** Lerro garbiak, 1.5px - 2px-ko lodiera, testuaren kolore berekoak edo **Primary** (`#D91B42`) / **Accent** (`#D2F535`) koloreetan nabarmenduta.


### 6.4. Botoiak

Botoiek hierarkia bisual argia jarraitzen dute, erabiltzailea ekintza nagusira (sarrerak erostea) bideratzeko.

| Botoi Mota | Itxura eta Koloreak (Tabla Ofizialaren Arabera) | Erabilera Interfazean |
| :--- | :--- | :--- |
| **CTA Nagusia** | Atzealdea: **Primary** (#7A1C2C)<br>Testua: Zuria (#FFFFFF)<br>Bordeak: Biribildu leunak | Hero ataleko botoi nagusia (`Sarrerak erosi →`) eta formularioetako akzioak (`Filtratu`). |
| **Txartelak** | Atzealdea: **Secondary** (#260F10)<br>Testua: Zuria (#FFFFFF)<br>Hover: Akzentuzko argitasuna | Ekitaldi-txartel bakoitzaren barruko botoia (`Sarrerak erosi`). |
| **Header** | Atzealdea: Gardena<br>Bordea: Zuria (#FFFFFF)<br>Testua: Zuria | Goiburuko akzioak (`Erregistratu / Saioa`). |
| **Text link** | Atzealdea: Gardena<br>Testua: Zuria / **Primary** | Navigazio simplerako estekak (`Ekitaldiak`). |


### 6.5. Irudiak

Webguneko argazkiek eta kartelak garrantzi handia dute ikuskizunak erakargarri egiteko. Irudiak hiru modutan erabiliko dira:

* **Argazki Nagusia (Goiko Bannerra):** Webgunearen goialdean argazki handi eta zabal bat jarriko da ikuskizun nagusia nabarmentzeko. Testua ondo irakurtzeko, argazkiak atzealde iluna izando du.
* **Ekitaldien Argazkiak (Txartelak):** Ekitaldi bakoitzak bere kartel edo argazkia izango du neurri berean, dena ordenatuta ikus dadin.
* **Etiketak Argazkien Gainean:** Argazkien goiko ertzean etiketa txikiak jarriko dira ikuskizun mota adierazteko (adibidez: *Antzerkia*, *Musika*, *Dantza*) edo ekitaldia gomendatua dela nabarmentzeko.

<br>

## 7. Prototipoa

[Esteka](https://www.figma.com/make/cSZZR61VIvdkEErPISoQ94/Bergara-Antzoki-Web?p=f&t=oeZJ5F1ilhsOBIHI-0)

<br>

## 8. Edukien lizentzia

Edukien lizentziari dagokionez, ondorengo lerrotan jasota geratzen da erabiliko diren lizentzia iturriak:

- **Tipografia:**
  
  Google Fonts erabiliko da letra motentzat. Hau kode irekiko lizentzia da. Dohakoa

- **Ikonoak:**

  BootStrap Icons erabiliko da. Hau 2000 ikonoz goraztik osatutako kode irekiko, dohakoa eta kalitate handiko erraminta da.
  Ordainketa ikonoak visa txartela etab... Banku pasarelak samurtutakoak izango dira.
  
- **Irudiak:**

  Webgune honetarako irudi portzentai handiena ekitaldiena izango da, hauen irudiak, ekitaldi arduradunak erraztuko ditu. Arduradun hauek izango direlarik lizentziaren arduradunak.

  Bestelako argazkiak berriz ondorengo webguneetatik jasoko dira: [Unsplash.com](https://unsplash.com/es) , [Pixabay](https://pixabay.com/es/), [Pexels](https://www.pexels.com/es-es/) Hauek lizentzia propiodunak eta dohakoak izango dira.

  <br>

## 9. Erabilgarritasunaren azterketa

   Bergarako Antzoki Web webgunea garatzean erabilgarritasuna ardatz nagusietako bat izango da, erabiltzaile-profil anitza (gazteak eta weberako ohitura gutxiko pertsona helduak) kontuan hartuta.

**Kontuan hartu beharrekoak:**

  - ISO 9241-11: Efikazia (Erabiltzaileak bere helburua lortzea. Adibidez, programazioa kontsultatzea, emanaldi baten informazioa aurkitzea, sarrerak erostea edo antzokiarekin harremanetan jartzea).
    
  - ISO 9241-11: Efizientzia (klik eta esfortzu gutxi).
    
  - ISO 9241-11: Gogobetetasuna (erabiltzaileak webgunea erabiltzean esperientzia positiboa izatea, erosotasuna eta konfiantza sentituz).

Nielsenen 10 heuristikoak: egoeraren ikusgarritasuna, hizkuntza ulergarria, kontrola eta askatasuna, koherentzia, erabilera malgutasuna, erroreen prebentzioa, menuak ikusgai, diseinu minimalista, akatsen konponbidea eta laguntza FAQ.

**Gaur egunera egokitzeko ere kontutan izan dira:**
   
  - Irisgarritasuna: alt testuak, aria-label atributuak, kontraste nahikoa eta teklatuarekin nabigatzeko aukera.
  
  - Mobile first eta abiadura: botoi handiak, beheko nabigazio barra iraunkorra eta 2 segundo azpiko karga.
  
  - Irakurketa-ereduak: informazio garrantzitsuena eta ekintza-deiak toki egokian jarriko dira.

  - Webgunean 65 urtetik gorakoentzat, sarrerak erostean, erroreen prebentzioa eta diseinu minimalistagoa landuko da bereziki, hau silver economi atalaren barruan jorratuko da.

**Emango diren pausoak:**

  - Analisi heuristikoa: prototipoa Nielsenen 10 printzipioen arabera berrikusi, eta aurkitutako arazoak zuzendu.
  
  - Irisgarritasun-berrikuspena: kontrastea, testu-tamainak eta alt testuak egiaztatu, batez ere testu txiki eta grisetan.
  
  - Erabiltzaile testak: 5 erabiltzailerekin (profil gazteak eta helduak nahastuz) zeregin zehatzak proposatu: ekitaldi bati buruzko informazioa lortzeko prozesutik hasi eta sarrerak erosteko prozesuraino. Horrela arazoen %85 inguru detektatuko da.
  
  - Gogobetetasun inkesta: SUS galdetegia pasatu proba ondoren.
  
Hobekuntzak eta berriz probatzea: emaitzen arabera diseinua doitu eta aldaketak berrikusi.

<br>

## 10. Bibliografia eta webgrafia

Bergarako antzokiko webgunearen diseinua burutzerako orduan, ondorengo iturriak kontsultatu dira:

- Erabilgarritasuna, diseinu-printzipioak, irisgarritasuna, estilo-gida, tipografia eta baliabide teknikoak:

   - Miguel Altuna Lanbide Heziketa (2026-2027) ikasmateriala.
   - Tipografia: [Google Fonts](https://fonts.google.com/)
   - Koloreak: [Realtimecolors](https://www.realtimecolors.com/)
   - Irudiak: [Unsplash.com](https://unsplash.com/es) , [Pixabay](https://pixabay.com/es/), [Pexels](https://www.pexels.com/es-es/)
   - Ikonoak: [BootStrap Icons](https://icons.getbootstrap.com/)
   - [IA Figma](https://www.figma.com/)
   - [IA Claude](https://claude.ai/)
 
- Benchmarka (aztertutako webguneak)
  
  - [Arkupe Aretxabaleta](https://www.aretxabaleta.eus/es/arkupe/agenda)
  - [Amaia Antzokia Arrasate](https://amaiaarrasate.janto.es/)
  - [Coliseo Eibar](https://www.eibar.eus/es/cultura/coliseo/cartelera-de-cine-en-el-coliseo)
  - [Elgoibar Herriko Antzokia](https://herrikoantzokia.eus/)

<br>

# PRODUKTU FINALA

<br>

## AURKIBIDEA

- [1. Sarrera Finala](#1-sarrera-finala)
- [2. Testuingurua](#2-testuingurua)
- [3. Helburuak](#3-helburuak)
- [4. Zereginak](#4-zereginak)
- [5. Baliabideak](#5-baliabideak)
- [6. Ondorioak](#6-ondorioak)
- [7. Webgrafia](#7-webgrafia)
- [8. Eranskina](#8-eranskina)

## 1. Sarrera Finala

Proiektu honetan zehar, Bergarako ekitaldi-enpresarentzako irtenbide teknologiko bat garatuko da, horretarako, web-garapena, negozio-kudeaketa, eta zerbitzari zein sareen konfigurazioa uztartuko dira. Hainbat tresna eta teknologia erabiliko dira, enpresaren beharrei erantzuten dien ingurune funtzional bat sortzeko.

## 2. Testuingurua

Bergaran, ekitaldi-enpresa batek plataforma digital bat garatzeko enkargua eman digu, bere kultur ekintzak kudeatzeko eta bezeroekiko komunikazioa errazteko. Proiektuak webgune bat garatzea dakar, Laravel framework-a erabiliz; bertan, erabiltzaileek kultur egitaraua kontsultatu, ekitaldi zehatzei buruzko informazioa eskuratu eta sarrerak erosi ahal izango dituzte. Plataformak administrazio-atal pribatu bat ere izango du, ekitaldiak, salmentak, langileak eta enpresaren jarduerarekin lotutako beste alderdi batzuk kudeatzeko.

Horrez gain, Odoo enpresa-kudeaketako sistema independente gisa konfiguratuko da, produktu, langile, ekitaldi, kontaktu eta atariko erabiltzaileei buruzko datuak gordetzeko. Beharrezko azpiegitura teknologikoa ere ezarriko da: Windows 11 sistema eragilea duen makina birtual batean Apache Lounge erabiliko da, eta, horrez gain, Ubuntu Server instantzia bat prestatuko da Odoo-rako. Hori guztia osatzeko, sarearen konfigurazioa egingo da, eta webgunerako sarbidea mugatzeko diseinatutako bideratzaile (router) bat instalatuko da.

## 3. Helburuak

1. Webgunearen garapena: Laravel erabiliz webgune bat sortzea, enpresaren informazioa eta haren kultur programazioa erakusteko.

2. Ekitaldien kudeaketa (CRUD): Kultur ekitaldiak ikusi, sortu, aldatu eta ezabatzeko aukera ematen duen sistema bat ezartzea.

3. Sarreren salmenta: Erabiltzaileek eskuragarritasuna egiaztatu eta ekitaldietarako sarrerak erosteko aukera izango duten sistema bat garatzea.

4. Administrazio-panela: Atal pribatu bat sortzea, ekitaldiak, salmentak, langileak eta webgunearekin lotutako bestelako informazioa kudeatzeko.

5. Odoo-ren konfigurazioa: Odoo sistema independente gisa instalatu eta konfiguratzea, enpresaren informazioa kudeatzeko.

6. Langileen kudeaketa: Odoo-ren barruan langileei, sailei, lanpostuei eta sarbide-baimenei buruzko erregistroak sortu eta kudeatzea.

7. Produktuen eta ekitaldien kudeaketa Odoo-n: Enpresaren jarduerarako beharrezkoak diren produktuak, ekitaldiak eta bestelako erregistroak administratzea.

8. Apache Lounge-ren konfigurazioa: Apache Lounge instalatu eta konfiguratzea Windows 11 sistema eragilea duen makina birtual batean, Laravel bidez garatutako webgunea ostatatzeko eta zerbitzatzeko.

9. Ubuntu Server-en konfigurazioa: Ubuntu Server makina birtual bat prestatzea, Odoo instalatu eta exekutatzeko.

10. Sarearen konfigurazioa: Hainbat sistemak funtzionatzeko beharrezkoak diren komunikazio- eta sare-ezarpenak ezartzea.

11. Bideratzailearen (router) konfigurazioa: Bideratzailea konfiguratzea webgunerako sarbidea mugatzeko; horrela, sare horretara konektatutako gailuek soilik izango dute sarbidea.

12. Funtzionamendu-probak: Webguneak, Odoo-k, zerbitzariek eta sare-azpiegiturak behar bezala funtzionatzen dutela egiaztatzea.

## 4. Zereginak

Zeregin guztiak sailkatu eta GitHub-eko proiektu batean gehitu genituen, bertan, pertsona bakoitzari zeregin desberdin bat esleitu zitzaion Eta horrela guk talde lanean egindako lana kudeatu egin dezakegu taldean eta lan guztiak banatu.

[Zereginak GitHub](https://github.com/users/web25llangaran/projects/6/views/1)

## 5. Baliabideak

**Software:**

- Laravel
- Visual Studio Code
- Draw\.io
- Odoo
- Apache
- Postgres
- PHP
- VmWare
- Ubuntu Server
- Windows SE

**Hardware:**

- 4 ordenagailu
- Windows 11 sistema eragilea.
- Visual Studio Code
- Laravel
- JavaScript, HTML, CSS
- MySQL
- Git eta GitHub
- Figma.com
- Interneteko sarbidea
- Wifi Router-a
- MAC Ordenagailua
- Sareko kablea

**GIZA BALIABIDEAK:**

- Lau informatikari: App-en analisi, diseinu eta programazioan adituak.
- Denbora estimazioa: 6-7 astekoa. 160 ordu, 32 lanegun 5 ordukoak.

## 6. Ondorioak

**Ikasketa ondorioak:**

Proiektu honen helburua da honako ezagutza eta gaitasun hauek eskuratzea eta garatzea erraztu digute:

1. Web-aplikazioen garapena: Web-aplikazio bat sortzen eta kudeatzen ikastea, Laravel eta haren oinarrizko funtzionaltasunak erabiliz.

2. Datu-baseen kudeaketa: Informazioa nola biltegiratu, antolatu eta administratzen den ulertzea, Odoo bezalako kudeaketa-sistemak erabiliz.

3. ERP sistemen administrazioa: Odoo konfiguratu eta erabiltzen ikastea, langileak, produktuak, ekitaldiak, kontaktuak eta erabiltzaileak kudeatzeko.

4. Zerbitzarien administrazioa: Windows 11n Apache Lounge eta Ubuntu Server-en Odoo instalatu eta konfiguratzeari buruzko ezagutzak eskuratzea.

5. Birtualizazioa: Makina birtualekin lan egiten eta sistema eragile desberdinak konfiguratzen ikastea, zerbitzu independenteak exekutatzeko.

6. Sareen konfigurazioa: Sareek nola funtzionatzen duten, IP helbideak nola konfiguratu eta gailu desberdinak elkarren artean nola komunikatzen diren ulertzea.

7. Bideratzaileen (router) administrazioa: Bideratzaile bat konfiguratzen eta sarean ostatatutako zerbitzuetarako sarbide-murrizketak ezartzen ikastea.

**Talde ondorioak:**

- Azkenean, taldean kudeatu izan ditugu bakoitzaren zereginak eta bete egin ditgu.
- Bakoitzak bere kompremezuak bete ditu.

**Hobekuntzak:**

- Gure talde-laneko denbora hobeto kudeatzea.
- Taldean hitz gehiago egin zereginak hobeto kudeatzeko.


## 7. Webgrafia

- MIguel Altunako apunteak
- [ChatGPT](https://chatgpt.com/)
- [Claude](https://claude.ai/)

## 8. Eranskina
# Laravel proiektua hedatzea Apache Lounge erabiliz

---

## AURKIBIDEA

- [Baliabideak](#baliabideak)
- [Baldintzak](#baldintzak)
- [1. Helburua eta funtzionamendua](#1-helburua-eta-funtzionamendua)
- [2. Apache Lounge konfigurazioa](#2-apache-lounge-konfigurazioa)
  - [Modulua](#modulua)
  - [Probak](#probak)
  - [Zerbitzuak eta Firewall](#zerbitzuak-eta-firewall)
- [3. Laravel proiektua](#3-laravel-proiektua)
  - [Dependentziak](#dependentziak)
  - [Probak](#probak-1)
- [4. .env fitxategia](#4-env-fitxategia)
  - [Probak](#probak-2)
- [5. Datu basea](#5-datu-basea)
  - [Probak](#probak-3)
- [6. Frontend](#6-frontend)
  - [Probak](#probak-4)
- [7. Virtual Host eta DNS lokala](#7-virtual-host-eta-dns-lokala)
  - [DNS-a](#dns-a)
- [8. Azken probak](#8-azken-probak)
- [9. Erabiltzaileak](#9-erabiltzaileak)

---

## Baliabideak

| Baliabidea | Erabilitako teknologia |
|---|---|
| Sistema zerbitzaria | Windows 11 |
| Web zerbitzua | Apache HTTP Server – Apache Lounge |
| Aplikazioa | Laravel (PHP) |
| Sarbidea | http://(ZERBITZARIAREN IP-A) |

## Baldintzak

- Windows 11 darabilen ordenagailu bat; webgunea erabiltzen den bitartean piztuta egon beharko duena.
- Apache Lounge, Windows-erako PHP eta Composer.
- Laravel proiektu oso bat eta, hala badagokio, MySQL edo MariaDB.
- Tokiko sarerako konexioa. Gida honek sare lokalaren (LAN) barruko sarbidea lantzen du; ez, ordea, Interneten zuzenean argitaratzea.

## 1. Helburua eta funtzionamendua

Helburua da gure web orrialdea (Laravel proiektu bat) Windows 11 sistema eragilea duen ordenagailu batean ostatatzea, eta sare lokal bereko beste gailu batzuei web orri horretara sartzeko aukera ematea, ostalari-ordenagailuaren IP helbidea erabiliz.

## 2. Apache Lounge konfigurazioa

### Modulua

1. Deskargatu `mod_fcgid.so` hemendik: https://www.apachelounge.com/download/
2. Gorde `C:\Apache24\modules` karpetan.
3. Editatu `C:\Apache24\conf\httpd.conf`, zure karpetaren ruta jarri.

```apache
Define SRVROOT "C:/Apache24"
ServerName localhost:80
```

4. Iruzkin-markak kendu:

```apache
LoadModule rewrite_module modules/mod_rewrite.so
LoadModule headers_module modules/mod_headers.so
LoadModule ssl_module modules/mod_ssl.so
LoadModule socache_shmcb_module modules/mod_socache_shmcb.so
LoadModule fcgid_module modules/mod_fcgid.so
```

5. Editatu `DirectoryIndex` lerroa. Bakarrik index bat agertuko da, bestea jarri beharko da.

```apache
DirectoryIndex index.php index.html
```

6. Bloc-eko edozein lekutan gehitu hau:

```apache
<IfModule fcgid_module>
    FcgidInitialEnv PHPRC "C:/php"
    FcgidInitialEnv PHP_FCGI_MAX_REQUESTS 1000
    <Files ~ "\.php$">
        Options +ExecCGI
        AddHandler fcgid-script .php
        FcgidWrapper "C:/php/php-cgi.exe" .php
    </Files>
</IfModule>
```

7. Iruzkin-markak kendu:

```apache
Include conf/extra/httpd-vhosts.conf
```

### Probak

1. CMD ireki eta idatzi:

```cmd
cd C:\Apache24\bin\
```

2. Konfigurazioa egiaztatu:

```cmd
httpd.exe -t
```

Ondo funtzionatzen badu, hau agertu behar da:

```text
Syntax OK
```

3. Moduluak egiaztatu:

```cmd
httpd.exe -M | findstr /i "rewrite ssl headers fcgid"
```

4 modulu agertu behar dira.

### Zerbitzuak eta Firewall

1. CMD-a ireki eta idatzi:

```cmd
cd C:\Apache24\bin\
```

Apache zerbitzua instalatu, eskuz abiarazi behar ez izateko:

```cmd
httpd.exe -k install
```

2. PowerShell ireki eta Apache zerbitzua abiarazi:

```powershell
Start-Service Apache2.4
```

3. Baimendu 80 eta 443 portuak Firewallean. Ireki PowerShell administratzaile bezala:

```powershell
New-NetFirewallRule -DisplayName "HTTP" -Direction Inbound -Protocol TCP -LocalPort 80 -Action Allow

New-NetFirewallRule -DisplayName "HTTPS" -Direction Inbound -Protocol TCP -LocalPort 443 -Action Allow
```

#### Probak

1. Joan web-nabigatzailera eta URL-an idatzi:

```text
http://localhost
```

"It works!" agertu beharko da.

2. PowerShell ireki:

```powershell
Get-Service Apache2.4
```

`Running` jarri beharko du funtzionatu ahal izateko.

## 3. Laravel proiektua

1. Jaitsi Laravelen proiektua.
2. Sortu `www` karpeta bat `C:\` unitatean.
3. Ireki CMD karpeta horretan (`C:\www`) eta klonatu biltegia:

```cmd
git clone https://github.com/web25llangaran/WepakBergarakoAntzokia.git
```

### Dependentziak

1. PowerShell ireki:

```powershell
cd C:\www\WepakBergarakoAntzokia
```

2. Erakutsi Boost, Debugbar eta abar dauden lerroak:

```powershell
Select-String -Path composer.json -Pattern "boost|debugbar" -Context 1,1
```

3. Ezabatu cache fitxategiak:

```powershell
Remove-Item bootstrap\cache\packages.php, bootstrap\cache\services.php, bootstrap\cache\config.php -ErrorAction SilentlyContinue
```

4. Instalatu dependentziak:

```powershell
composer install --no-dev --optimize-autoloader --no-scripts
```

5. Exekutatu:

```powershell
php artisan package:discover --ansi
```

#### Probak

1. Proiektuko karpetan ireki PowerShell.
2. Egiaztatu `vendor/autoload.php` fitxategia dagoela. `True` eman behar du:

```powershell
Test-Path vendor\autoload.php
```

3. Laravel bertsioa ikusteko:

```powershell
php artisan --version
```

4. Ez du ezer itzuli behar:

```powershell
Select-String -Path bootstrap\cache\packages.php -Pattern "debugbar"
```

## 4. .env fitxategia

Hori guztia egindakoan, Laravel proiektura pasatuko ginateke eta lehen urratsa egingo genuke: `.env` fitxategia sortzea eta editatzea, betiko pausoak eginez.

Ondoren, hau jarri:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=http://bergara.antzokia
```

### Probak

1. Konfigurazioa garbitu:

```powershell
php artisan config:clear
```

2. Exekutatu:

```powershell
php artisan about
```

Hau agertu behar da:

```text
Environment: production
Debug Mode: OFF
```

## 5. Datu basea

Exekutatu migrazioak:

```powershell
php artisan migrate --force
```

### Probak

Migrazioen egoera egiaztatu:

```powershell
php artisan migrate:status
```

Migrazioak `Ran` egoeran egon behar dira.

## 6. Frontend

Exekutatu komando hauek:

1. Instalatu dependentziak:

```powershell
npm ci
```

2. Sortu frontend fitxategiak:

```powershell
npm run build
```

### Probak

Egiaztatu manifest fitxategia sortu dela:

```powershell
Test-Path public\build\manifest.json
```

`True` eman behar du.

## 7. Virtual Host eta DNS lokala

1. Editatu fitxategi hau:

```text
C:\Apache24\conf\extra\httpd-vhosts.conf
```

2. Ezabatu adibidezko Virtual Host-ak eta kopiatu hau:

```apache
<VirtualHost *:80>
    ServerName bergara.antzokia
    DocumentRoot "C:/www/WepakBergarakoAntzokia/public"

    <Directory "C:/www/WepakBergarakoAntzokia/public">
        Options +FollowSymLinks +ExecCGI
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog "logs/got-error.log"
    CustomLog "logs/got-access.log" common
</VirtualHost>
```

### DNS-a

1. Ireki PowerShell administratzaile bezala:

```powershell
Add-Content C:\Windows\System32\drivers\etc\hosts "127.0.0.1 bergara.antzokia"
```

2. Apache konfigurazioa egiaztatu:

```powershell
C:\Apache24\bin\httpd.exe -t
```

3. Zerbitzua berrabiarazi:

```powershell
Restart-Service Apache2.4
```

## 8. Azken probak

### CMD bidezko proba

Ireki CMD eta idatzi:

```cmd
curl.exe -I http://bergara.antzokia
```

Emaitza hau izan behar da:

```text
HTTP/1.1 200 OK
```
![irudia](Irudiak%20eranskina/HTTP1.1%20200%20OK.png)

### Apache konfigurazioaren proba

```cmd
C:\Apache24\bin\httpd.exe -t
```

Emaitza hau izan behar da:

```text
Syntax OK
```

AH00112 abisurik gabe.

![irudia](Irudiak%20eranskina/Syntax%20OK.png)

### Nabigatzailean

Probatu URL hauek:

**1. Existitzen ez den orrialdea:**

```text
http://bergara.antzokia/ezer-ez-dago
```

Emaitza:

```text
404 | NOT FOUND
```
![irudia](Irudiak%20eranskina/httpbergara.antzokiaezer-ez-dago.png)

**2. .env fitxategiaren sarbidea:**

```text
http://bergara.antzokia/.env
```

Emaitza:

```text
404 | NOT FOUND
```
![irudia](Irudiak%20eranskina/httpbergara.antzokia.env.png)

### Orrialdea

![irudia](Irudiak%20eranskina/WebOrrialdea.png)

## 9. Erabiltzaileak

### WEB ORRIALDEA

### URL-a

- http://bergarakoantzokia.eus

### Admin

- admin@gmail.com
- pasahitza: 12345678

### Arrunta

- arrunta@gmail.com
- pasahitza: 12345678

### URL-a

- bergarakoantzokia.eus

### ODOO

### Admin

- admin@gmail.com
- pasahitza: 12345678

### URL-a

- bergarakoantzokiaodoo.eus:8069

### WIN 11

- Wepak
- pasahitza: 12345678

### Ubuntu server

- wepak
- pasahitza: 12345678

### Router

- ip: 192.168.1.1
- pasahitza: Wepak12345678

### Wifi

- Izena: WepakBergaraAntzokia
- pasahitza: 12345678

### Router

- ip: 192.168.1.1
- pasahitza: Wepak12345678
