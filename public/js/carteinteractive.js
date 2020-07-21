var map = document.querySelector('#map')    
/* variable de selection par query de l'élément qui à l'id "map" */
var paths = map.querySelectorAll('.map__image a')   
/* variable de selection par queryAll des paths(elements geometriques de la carte) 
de la div map__image et qui sont des liens*/
var links = map.querySelectorAll('.map__list a')    
/* select tous les elements dans l'élément maps et qui sont des liens */


// Polyfill pour rendre le foreach accessible partout
/*si sur nodelist je n'ai pas de methode forEach alors je créer le polyfill */
if (NodeList.prototype.forEach === undefined) {
    NodeList.prototype.forEach = function (callback) {
        [].forEach.call(this, callback)
    }
}


/* fonction zone active qui récupère le id region- et list-*/
var zoneActive = function (id) {
    /* query Selectionner tout les class is-active et ForEach avec une fonction 
qui recupère l'élement actif 'item' et on lui retire la class is-active*/
map.querySelectorAll('.is-active').forEach(function (item) {
    item.classList.remove('is-active')
})
/*condition pour MOUSE OVER */
/* si id est défini alors attribue class 'is-active' */
if (id !== undefined) {
/* query select list et region + id (ex: list-HDF et region-HDF) 
et leur ajoute au survol la class "is-active" */
    document.querySelector('#list-' + id).classList.add('is-active')
    document.querySelector('#region-' + id).classList.add('is-active')
}
}

/* images select */
paths.forEach(function (path) {
/* paths.foreach selectionne tous les chemins et 
lance une fonction a chaque chemin en question */
    path.addEventListener('mouseenter', function () {
/* addeventlistener ecoute le mouse enter (moment de l'entrée dans la zone) 
cela lance une fonction qui prend en parametre l'evenement et ne fait rien) */
        var id = this.id.replace('region-','')
/* replace region-id par id seulement */
        zoneActive(id)
    })
})

/* link select */
links.forEach(function (link) {
    link.addEventListener('mouseenter', function () {
        var id = this.id.replace('list-', '')
        zoneActive(id)
    })
})

/* Lorsque tu quitte la zone active */
map.addEventListener('mouseover', function () {
    /* zoneActive sans id */
    zoneActive()
})