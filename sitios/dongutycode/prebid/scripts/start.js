(function () {

    var DGC = function () {
        //Private
        _init = function (dgc) {
            if (!dgc) {
                _getScript('scripts/dgc.js', _run)
                return
            }
            _run()
        }

        _run = function () {
            window.DGC = new DGCFeeds(initAdserver)
        }

        _getScript = function (url, callback) {
            var head = document.getElementsByTagName('head')[0],
                done = false,
                script = document.createElement('script')

            script.src = url

            if (script.readyState) {
                script.onreadystatechange = function () {
                    if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
                        script.onreadystatechange = null
                        done = true
                        callback()
                    }
                }
            } else {
                script.onload = function () {
                    callback()
                }
            }

            head.appendChild(script)
        }

        //Public
        return {
            init: _init
        }
    }()

    var dgc = true
    if (!window.DGC) {
        dgc = false
    }

    //Run app
    DGC.init(dgc)

})()

var PREBID_TIMEOUT = 3000

var adUnits = [
    {
        code: 'div-ad-1',
        mediaTypes: {
            banner: {
                sizes: [[728, 90]]
            }
        },
        bids: [{
            bidder: 'appnexus',
            params: {
                member: 958,
                invCode: 'prebid-challenge-appnexus'
            }
        },
        {
            bidder: 'bidderA',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-a'
            }
        },
        {
            bidder: 'bidderB',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-b'
            }
        },
        {
            bidder: 'bidderC',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-c'
            }
        }]
    },
    {
        code: 'div-ad-2',
        mediaTypes: {
            banner: {
                sizes: [[300, 250]]
            }
        },
        bids: [{
            bidder: 'appnexus',
            params: {
                member: 958,
                invCode: 'prebid-challenge-appnexus'
            }
        },
        {
            bidder: 'bidderA',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-a'
            }
        },
        {
            bidder: 'bidderB',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-b'
            }
        },
        {
            bidder: 'bidderC',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-c'
            }
        }]
    },
    {
        code: 'div-ad-3',
        mediaTypes: {
            banner: {
                sizes: [[728, 90]]
            }
        },
        bids: [{
            bidder: 'appnexus',
            params: {
                member: 958,
                invCode: 'prebid-challenge-appnexus'
            }
        },
        {
            bidder: 'bidderA',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-a'
            }
        },
        {
            bidder: 'bidderB',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-b'
            }
        },
        {
            bidder: 'bidderC',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-c'
            }
        }]
    },
    {
        code: 'div-ad-4',
        mediaTypes: {
            banner: {
                sizes: [[728, 90]]
            }
        },
        sizes: [[728, 90]],
        bids: [{
            bidder: 'appnexus',
            params: {
                member: 958,
                invCode: 'prebid-challenge-appnexus'
            }
        },
        {
            bidder: 'bidderA',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-a'
            }
        },
        {
            bidder: 'bidderB',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-b'
            }
        }]
    },
    {
        code: 'div-ad-5',
        mediaTypes: {
            banner: {
                sizes: [[728, 90]]
            }
        },
        sizes: [[728, 90]],
        bids: [{
            bidder: 'appnexus',
            params: {
                member: 958,
                invCode: 'prebid-challenge-appnexus'
            }
        },
        {
            bidder: 'bidderA',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-a'
            }
        },
        {
            bidder: 'bidderB',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-b'
            }
        }]
    },
    {
        code: 'div-ad-6',
        mediaTypes: {
            banner: {
                sizes: [[300, 250]]
            }
        },
        sizes: [[300, 250]],
        bids: [{
            bidder: 'appnexus',
            params: {
                member: 958,
                invCode: 'prebid-challenge-appnexus'
            }
        },
        {
            bidder: 'bidderA',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-a'
            }
        },
        {
            bidder: 'bidderB',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-b'
            }
        }]
    },
    {
        code: 'div-ad-7',
        mediaTypes: {
            banner: {
                sizes: [[728, 90]]
            }
        },
        sizes: [[728, 90]],
        bids: [{
            bidder: 'appnexus',
            params: {
                member: 958,
                invCode: 'prebid-challenge-appnexus'
            }
        },
        {
            bidder: 'bidderA',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-a'
            }
        },
        {
            bidder: 'bidderB',
            params: {
                member: 958,
                invCode: 'prebid-challenge-bidder-b'
            }
        }]
    },
    {
        code: 'div-ad-8',
        mediaTypes: {
            video: {
                playerSize: [[640, 480]],
                context: 'outstream'
            }
        },
        sizes: [[640, 480]],
        bids: [{
            bidder: 'bidderD',
            params: {
                placementId: 13232385
            }
        }]
    }
]

var googletag = googletag || {}
googletag.cmd = googletag.cmd || []
googletag.cmd.push(function () {
    googletag.pubads().disableInitialLoad()
})

var pbjs = pbjs || {}
pbjs.que = pbjs.que || []

pbjs.que.push(function () {
    pbjs.aliasBidder('appnexus', 'bidderA')
    pbjs.aliasBidder('appnexus', 'bidderB')
    pbjs.aliasBidder('appnexus', 'bidderC')
    pbjs.aliasBidder('appnexus', 'bidderD')
    pbjs.setConfig({ priceGranularity: 'dense' })
    pbjs.addAdUnits(adUnits)
    /*pbjs.requestBids({
        bidsBackHandler: initAdserver,
        timeout: PREBID_TIMEOUT
    })*/
})

var initialSlots = []

googletag.cmd.push(function () {
    var ad_1 = googletag.defineSlot('/1000804/prebid-challenge', [[728, 90]], 'div-ad-1').addService(googletag.pubads())
    googletag.pubads().enableSingleRequest()
    googletag.enableServices()

    var ad_2 = googletag.defineSlot('/1000804/prebid-challenge', [[300, 250]], 'div-ad-2').addService(googletag.pubads())
    googletag.pubads().enableSingleRequest()
    googletag.enableServices()

    var ad_3 = googletag.defineSlot('/1000804/prebid-challenge', [[728, 90]], 'div-ad-3').addService(googletag.pubads())
    googletag.pubads().enableSingleRequest()
    googletag.enableServices()
    initialSlots.push(ad_1, ad_2, ad_3)
})

function initAdserver() {
    if (pbjs.initAdserverSet) return
    pbjs.initAdserverSet = true
    googletag.cmd.push(function () {
        pbjs.que.push(function () {
            pbjs.setTargetingForGPTAsync()
            googletag.pubads().refresh(initialSlots)
        })
    })
}

function moreAdSlot() {
    var adUnit = DGCFeeds.adPosition
    var ad
    googletag.cmd.push(function () {
        ad = googletag.defineSlot('/1000804/prebid-challenge', [[728, 90]], adUnit).addService(googletag.pubads())
        googletag.pubads().enableSingleRequest()
        googletag.enableServices()
    })

    pbjs.que.push(function () {
        pbjs.requestBids({
            timeout: PREBID_TIMEOUT,
            adUnitCodes: ['/1000804/prebid-challenge'],
            bidsBackHandler: function () {
                pbjs.setTargetingForGPTAsync(['/1000804/prebid-challenge']);
                googletag.pubads().refresh([ad]);
            }
        });
    });
}
/*
var
    firstScroll = false,
    secountScroll = false
window.document.onscroll = function () {
    if (!firstScroll && window.scrollY >= 1000) {
        firstScroll = true
        var firstSlots = []
        googletag.cmd.push(function () {
            var ad_4 = googletag.defineSlot('/1000804/prebid-challenge', [[728, 90]], 'div-ad-4').addService(googletag.pubads())
            googletag.pubads().enableSingleRequest()
            googletag.enableServices()

            var ad_6 = googletag.defineSlot('/1000804/prebid-challenge', [[300, 250]], 'div-ad-6').addService(googletag.pubads())
            googletag.pubads().enableSingleRequest()
            googletag.enableServices()

            var ad_8 = googletag.defineSlot('/1000804/prebid-challenge', [[1, 1]], 'div-ad-8').addService(googletag.pubads())
            googletag.pubads().enableSingleRequest()
            googletag.enableServices()
            firstSlots.push(ad_4, ad_6, ad_8)
        })

        pbjs.que.push(function () {
            pbjs.requestBids({
                timeout: PREBID_TIMEOUT,
                adUnitCodes: ['div-ad-4', 'div-ad-6', 'div-ad-8'],
                bidsBackHandler: function () {
                    pbjs.setTargetingForGPTAsync(['div-ad-4', 'div-ad-6', 'div-ad-8'])
                    googletag.pubads().refresh(firstSlots)
                }
            })
        })
    }
    else if (!secountScroll && window.scrollY >= 2000) {

        secountScroll = true
        var secondSlots = []

        googletag.cmd.push(function () {

            var ad_5 = googletag.defineSlot('/1000804/prebid-challenge', [[728, 90]], 'div-ad-5').addService(googletag.pubads())
            googletag.pubads().enableSingleRequest()
            googletag.enableServices()

            var ad_7 = googletag.defineSlot('/1000804/prebid-challenge', [[728, 90]], 'div-ad-7').addService(googletag.pubads())
            googletag.pubads().enableSingleRequest()
            googletag.enableServices()
            secondSlots.push(ad_5, ad_7)
        })
        pbjs.que.push(function () {
            pbjs.requestBids({
                timeout: PREBID_TIMEOUT,
                adUnitCodes: ['div-ad-5', 'div-ad-7'],
                bidsBackHandler: function () {
                    pbjs.setTargetingForGPTAsync(['div-ad-5', 'div-ad-7'])
                    googletag.pubads().refresh(secondSlots)
                }
            })
        })

    }
}*/