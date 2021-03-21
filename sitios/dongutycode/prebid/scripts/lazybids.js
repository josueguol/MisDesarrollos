(function () {

    var DGC = function () {
        //Private
        _init = function () {
            _run()
        }

        _run = function () {
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

            window.pbjs = window.pbjs || {}
            window.pbjs.que = window.pbjs.que || []

            window.pbjs.que.push(function () {
                window.pbjs.aliasBidder('appnexus', 'bidderA')
                window.pbjs.aliasBidder('appnexus', 'bidderB')
                window.pbjs.aliasBidder('appnexus', 'bidderC')
                window.pbjs.aliasBidder('appnexus', 'bidderD')
                window.pbjs.setConfig({ priceGranularity: 'dense' })
                window.pbjs.addAdUnits(adUnits)
            })

            window.addEventListener('scroll', () => {
                var divs = document.querySelectorAll('.GoogleDfpAd')
                divs.forEach( (element) => {
                    var position = element.getBoundingClientRect();                    

                    // checking for partial visibility
                    if(position.top < window.innerHeight && position.bottom >= 0) {
                        console.log('Show ad');
                        _moreAdSlot('/1000804/prebid-challenge', element.getAttribute('data-slot-sizes'), element.id)
                    }
                })
            })
            
        }

        _moreAdSlot = function (iu, sizes, target) {
            var ad

            googletag.cmd.push(function () {
                ad = googletag.defineSlot(iu, JSON.parse(sizes), target).addService(googletag.pubads())
                googletag.pubads().enableSingleRequest()
                googletag.enableServices()
            })
        
            window.pbjs.que.push(function () {
                window.pbjs.requestBids({
                    timeout: PREBID_TIMEOUT,
                    adUnitCodes: [iu],
                    bidsBackHandler: function () {
                        window.pbjs.setTargetingForGPTAsync([iu]);
                        googletag.pubads().refresh([ad]);
                    }
                });
            });
        }

        //Public
        return {
            init: _init
        }
    }()

    //Run app
    DGC.init()
})()
