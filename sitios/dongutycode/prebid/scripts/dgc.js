class DGCFeeds {

    constructor(method) {
        this.feed = '/prebid/jsons/feed-page'
        this.start = 1
        this.pages = 3
        DGCFeeds.startAdPosition = 3
        DGCFeeds.adPosition = null
        DGCFeeds.method = method
        this.loadHistory()
    }

    loadHistory() {
        this.requestUrl(this.feed + this.start + '.json', this.feedItems)
        this.start++
    }

    requestUrl(feed, callback) {
        var request = new Request(feed)

        fetch(request).then((response) => {
            return response.text()
        }).then((data) => {
            let jsonObj = JSON.parse(data)
            callback(jsonObj)
        })
    }

    feedItems(jsonObj) {
        var adPosition = 2
        var position = 1
        jsonObj.items.forEach(item => {
            document.getElementById('feedItems').appendChild(DGCFeeds.fillItems(item))
            if (adPosition === position) {
                let adDiv = document.createElement('div')
                adDiv.className = 'p-3 col-xs-1 text-center'
                adDiv.id = 'div-ad-' + DGCFeeds.startAdPosition
                DGCFeeds.adPosition = 'div-ad-' + DGCFeeds.startAdPosition
                DGCFeeds.startAdPosition++
                document.getElementById('feedItems').appendChild(adDiv)
            }
            position++
        })

        if(DGCFeeds.method) {
            DGCFeeds.method()
        }
    }

    moreItems(callback) {
        if (this.start > this.pages) return
        this.requestUrl(this.feed + this.start + '.json', this.feedItems)
        this.start++
        DGCFeeds.method = callback
    }

    /*
    <div class="card mb-4">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    */
    static fillItems(json) {
        let parentDiv = document.createElement('div')
        parentDiv.className = 'card mb-4'

        let headerDiv = document.createElement('div')
        headerDiv.className = 'card-header'
        headerDiv.innerText = 'Notas'

        let bodyDiv = document.createElement('div')
        bodyDiv.className = 'card-body'

        let h5El = document.createElement('h5')
        h5El.className = 'card-title'
        h5El.innerText = json.titulo

        let pEl = document.createElement('p')
        pEl.className = 'card-text'
        pEl.innerText = json.teaser

        let aEl = document.createElement('a')
        aEl.className = 'btn btn-primary'
        aEl.href = json.compartir
        aEl.innerText = "Ver contenido"
        aEl.target = '_blank'

        bodyDiv.appendChild(h5El)
        bodyDiv.appendChild(pEl)
        bodyDiv.appendChild(aEl)

        parentDiv.appendChild(headerDiv)
        parentDiv.appendChild(bodyDiv)

        return parentDiv
    }
}