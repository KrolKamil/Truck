# Slim Framework 3 Skeleton Application

Use this skeleton application to quickly setup and start working on a new Slim Framework 3 application. This application uses the latest Slim 3 with the PHP-View template renderer. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Zadanie rekruacyjne z API

Jesteś kierowcą ciężarówki. Codziennie wozisz świeże bułki, wędliny itd.  
 Za każdy przejazd otrzymujesz zapłatę.  
 Chcesz napisać aplikację, która pomoże ci śledzić twoje przejazdy,  
 ilość przejechanych kilometrów i zarobionych pieniędzy.  

 #Zadanie
 
Stwórz serwis wystawiający JSON API zgodnie z załączoną dokumentacją,  
Serwis może zostać stworzony z użyciem dowolnej technologii,  
Użyj Gita do udokumentowania historii projektu,  
Logowanie nie jest wymagane  

##Dokumentacja

Endpoint do dodawania przejazdu. Zwróć uwagę, że klient nie dostarcza odległości pomiędzy punktami.  
Znajdź sposób, aby obliczyć ją po stronie serwera.  

#HTTP REQUEST

POST http://example.com/transits  

Zapytanie:  

{  
  "source_address":      "ul. Zakręt 8, Poznań",  
  "destination_address": "Złota 44, Warszawa",  
  "price":               450,  
  "date":                "2018-03-15"  
}  

#Get report

HTTP REQUEST  

GET http://example.com/reports/range?start_date=YYYY-MM-DD&end_date=YYYY-MM_DD  

Zapytanie:  

{  
  "start_date": "2018-01-20",  
  "end_date":  "2018-01-25"  
}  

Odpowiedz:  

{  
  "total_distance": 90,  
  "total_price":    115  
}  


#Get monthly report

Endpoint zwraca ilość przejechanych kilometrów,  
 średni dystans przejazdu oraz średnią zapłatę za przejazd dla każdego dnia w obecnym miesiącu  
 (np. dla daty 5 marca zwraca dni 1-4 marca).  
 
 HTTP REQUEST  

GET http://example.com/reports/monthly  

Odpowiedz:  

[  
  {  
    "date":           "March, 1st",  
    "total_distance": 240,  
    "avg_distance":   70,  
    "avg_price":      213.7  
  },  
  {  
    "date":           "March, 2nd",  
    "total_distance": 76,  
    "avg_distance":   76,  
    "avg_price":      90.3  
  },  
  <...>  
]  

#Dodatkowe punkty za:  

asynchroniczne obliczanie odległości pomiędzy dwoma punktami  
(user dodając przejazd nie czeka aż serwer przeliczy odległość, dzieje się to w backgroundzie)  
