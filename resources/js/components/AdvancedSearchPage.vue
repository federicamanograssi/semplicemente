<template>

    <main class="main main--advanced-search">

        <advanced-search-form 
            v-on:newQuery="getNewQuery($event)" 
            :currentQuery="currentQuery"
            :highestAptPrice="highestAptPrice"
            :lowestAptPrice="lowestAptPrice"
            :servicesList="servicesList"
            >

            <!-- Search Form -->

        </advanced-search-form>

        <apartments-list 
            :apartments="listApartments" 
            :mapIsShown="mapIsShown" 
             class="apartments-list--full-width">

            <!-- Lista degli appartamenti -->

        </apartments-list>

        <chalet-map 
            v-on:mapToggled="toggleMap()" 
            :baseLon="baseLon" 
            :baseLat="baseLat"
            :apartments="mapApartmens"
            :radius="currentQuery.maxDistance">

            <!-- Mappa -->

        </chalet-map>

    </main>
    
</template>

<script>
    export default {

        mounted() {
            this.currentQuery.maxPrice ? null : this.currentQuery.maxPrice = this.highestAptPrice;
            this.getServicesList();
            this.search();
        },
        data() {            
            return {
                
                // Liste di Appartamenti

                apartments: [] ,            // Lista Generale con tutti i risultati trovati
                filteredApartments : [] ,   // Appartamenti che soddisfano i filtri definiti dall'utente
                listApartments : [],        // Array ottimizzato per il component apartmentList
                mapApartmens : [],          // Array ottimizzato per il component chaletMap

                baseLat  : 0 ,  // latitudine località cercata
                baseLon : 0 ,   // Longituine località cercata

                servicesList : [],

                highestAptPrice  : 300  ,
                lowestAptPrice   :  0 ,

                currentQuery : {
                    baseLocation     : this.destination  ,
                    maxDistance      : 40 ,
                    guests           : 2 ,
                    minRating        : 1 ,
                    minRooms         : 1 ,
                    maxPrice         : null ,
                    selectedServices : []  ,
                } ,

                mapIsShown : true
            }
        },
        props : ['destination'] ,   // Arriva come parametro URL e deriva da uno dei link in home page oppure dalla località cha abbiamo scelo di default
        methods : {
            filterResults(){

                this.filteredApartments = [];   // Resetta lista appartamenti filtrati

                // Facciamo riferimento alla lista degli appartamenti generale
                // E filtriamo tutti quelli che corrispondono alle richieste dell'utente
                // il tutto tramite un ciclo for (preferito al foreach per la possibilità di usare 'continue')
                
                mainFor: for(let i = 0; i < this.apartments.length ; i++) {

                    const apt   = this.apartments[i];   // Alias
                    const query = this.currentQuery;    // Alias

                    if (apt.dist > query.maxDistance)   continue;   // Filtro distanza
                    if (apt.price > query.maxPrice)     continue;   // Filtro Prezzo
                    if ( apt.rating < query.minRating ) continue;   // filtro Punteggio
                    if ( apt.beds < query.guests )      continue;   // Filtro Posti letto
                    if ( apt.rooms < query.minRooms )   continue;   // Filtro Camere
                    
                    // Controllo Servizi Aggiuntivi

                    if (apt.services.length == 0){
                        continue    // Se non ci sono servizi aggiuntivi l'appartamento è scartato a priori
                    } else {
                        for(let i=0; i<query.selectedServices.length; i++){ // Ciclo tutti i servizi richiesti dall'utente
                            const reqServ = query.selectedServices[i];  // alias
                            let found = false;  // flag

                            for(let j=0; j<apt.services.length; j++){   // per ogni servizio richiesto controllo che sia presente fra quelli offerti dall'appartamento
                                const aptServ = apt.services[j];
                                if(aptServ == reqServ) found = true;    // Se il servizio è present porto il flag a true
                            }   // inner for

                            if (found == false) continue mainFor;       // se anche un solo servizio richiesto non era presente l'appartamento è scartato
      
                        }   // outer for
                    } // else

                    // Assegna casualmente una sponsorizzazione ad un apparamento su 3
                    // (Soluzione temporanea prima di ottenere l'informazione dal server)

                    let rNum = Math.floor(Math.random() * 3 ) + 1; 
                    rNum === 3 ? apt.isSponsored = true : apt.isSponsored = false;

                    this.filteredApartments.push(apt);   // Se l'appartamento soddisfa tutti i filtri lo pusho nell'array             
                                    
                }  // main for

                if (this.filteredApartments.length > 1) this.sortApartments();

                
                this.mapApartmens = this.filteredApartments.map(({lat, lon , id , name , price , isSponsored}) => ({lat, lon , id , name , price , isSponsored}));

                this.listApartments = this.filteredApartments.map(({id , name , price, dist, beds, rating, isSponsored, cover_img}) => ({id , name , price, dist, beds, rating, isSponsored, cover_img}));



                console.log("Lista appartamenti da passare alla mappa");
                console.log(this.mapApartmens);

            },
            sortApartments(){
                // Ordina gli appartamenti per distanza rispetto alla località cercata dall'utente
                // in seguito porta comunque gli appartamenti sponsorizzati nelle prime posizioni
                
                let sortedApt = []; //  Predispongo array
                    
                while(this.filteredApartments.length > 1) {
                    
                    let minDist   = this.filteredApartments[0].dist;    // Valore iniziale distanza minima impostata sul primio elemento
                    let closerApt = 0;  //elemento la cui distanza è quella inferiore

                    for(let i = 0; i < this.filteredApartments.length ; i++) {
                        
                        const apt   = this.filteredApartments[i];   // Alias

                        if(apt.dist <= minDist) {
                            minDist  = apt.dist;
                            closerApt = i;                            
                        }
                    }

                    sortedApt.push(this.filteredApartments[closerApt]); // aggiunge l'apt la cui distanza è quella minima all'array degli apt ordinati

                    this.filteredApartments.splice(closerApt , 1);  // Rimuove l'apt appena aggiunto dall'array principale per escluderlo dalle verifiche successive

                }

                sortedApt.push(this.filteredApartments[0]); // pusha l'ultimo apt rimasto nell'array principale (non gestito dal while)

                this.filteredApartments = [];

                // A questo punto filteredApartments è vuoto mentre sortApartments contiene tutti gli apt già ordinati
                // Devo adesso inserire nelle prime posizioni gli apt sponsorizzati
                
                // Ricreo l'array principale inserrendo ai primi posti gli apt sponsorizzati
                for(let i = 0; i < sortedApt.length ; i++)
                    if(sortedApt[i].isSponsored) this.filteredApartments.push(sortedApt[i]);

                // Dopo gli apt sponsorizzati inserisco quelli rimanenti                
                for(let i = 0; i < sortedApt.length ; i++)
                    if(!sortedApt[i].isSponsored) this.filteredApartments.push(sortedApt[i]);

            },
            toggleMap(){
                this.mapIsShown == false ? this.mapIsShown = true : this.mapIsShown = false;
            },
            getaptListInfo() {
                                                

                if (this.apartments.length == 0) return // Se la lista di appartamenti è vuota abbandona la fuzione

                // Definizione di prezzo minimo e massimo fra tutti gli
                // appartamenti presenti nell'array (filtrati e non)

                let maxPrice = this.apartments[0].price;
                let minPrice = this.apartments[0].price;

                this.apartments.forEach(apt => {
                    apt.price > maxPrice ? maxPrice = apt.price : null;
                    apt.price < minPrice ? minPrice = apt.price : null;
                });

                this.highestAptPrice = Math.ceil(maxPrice);
                this.lowestAptPrice  = Math.ceil(minPrice);

            } ,
            search() {
                console.log("Occhio: Sto per lanciare una nuova richiesa al server!");
                self = this;    // alias
                axios
                    .get('http://127.0.0.1:8000/api/location' , {
                        params: {
                            location    :   this.currentQuery.baseLocation ,
                            radius      :   this.currentQuery.maxDistance
                
                }
                        })
                    .then((response)=>{

                        // Trasformo la lista dei servizi da array di oggetti ad array di stringhe
                        // (Benché ciò dovrebbe avvenire lato server...)

                        response.data.results.forEach(apt => {
                            
                            if(apt.services.length>0){
                                
                                let tmpArray=[];
                                
                                apt.services.forEach(service => {
                                    service.service_id ? tmpArray.push(service.service_id) : null;                                
                                });

                                apt.services = tmpArray;
                            }
                        }); // Fine Conversione

                        self.apartments = response.data.results;

                        self.baseLat = response.data.base_lat;  // latitudine  località cercata dall'utente
                        self.baseLon = response.data.base_lon;  // Longitudine località cercata dall'utente

                        self.getaptListInfo();
                        self.filterResults();
                });
            } ,
            getNewQuery(newQuery){

                let newSearchIsNeeded = false;

                const oldQuery = this.currentQuery; // alias
                
                if((oldQuery.baseLocation != newQuery.baseLocation) || (oldQuery.maxDistance < newQuery.maxDistance) ){
                    newSearchIsNeeded = true;   // flag: se è cambiata la località o è aumentato il raggio serve una nuova ricerca nel DB
                }

                this.currentQuery = newQuery;           // sovrascrive la vecchia query con quella nuova

                if(newSearchIsNeeded) this.search();    // lancia una nuova ricerca nel DB se necessaio (il successivo filtraggio sarà richiamato dal metodo search() )
                             
                else this.filterResults();              // Se non è necessaria una nuova ricerca nel DB si limita a filtrare
                
            },
                getServicesList(){

                // Chiamata API che restituisce la lista complessiva dei servizi

                axios
                .get('http://127.0.0.1:8000/api/services')
                .then((servicesList)=>{                    
                    this.servicesList = servicesList.data.results;
                });
            }    
        }
    }
</script>
