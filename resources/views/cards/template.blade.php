<h1 class="margin-bottom-10">Hearthstone Card Collection</h1>
<div class="row">
    <div class="col-md-4">
        <div class="row margin-bottom-10">
            <div class="col-md-12">
                <h3>Search by name:</h3>
                <form method="GET" ng-submit="searchNameChanged();">
                    <input type="text" data-ng-model="search.name" ng-change="updateFiltered();"/>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Formats</h3>
            </div>
            <div class="col-sm-4 col-xs-3">
                <div class="margin-bottom-15">
                    <a class="btn-u btn-u-green" style="width:100;" ui-sref="filter({
                            page : undefined, 
                            type : search.type, 
                            set: search.set, 
                            class : search.class, 
                            rarity : search.rarity, 
                            standard : undefined
                        })" 
                        ng-class="search.isStd === undefinded ? 'btn-u-sea' : ''">
                        ALL
                    </a>
                </div>
            </div>
            <div class="col-sm-4 col-xs-3">
                <div class="margin-bottom-15">
                    <a class="btn-u" style="width:100;" ui-sref="filter({page : undefined, standard : 1})" ng-class="search.isStd ? 'btn-u-sea' : ''">STANDARD</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Rarities</h3>
            </div>
            <div class="col-sm-4 col-xs-3">
                <div class="margin-bottom-15">
                    <a class="btn-u btn-u-green" style="width:100;" ui-sref="filter({
                            page : undefined, 
                            type : search.type, 
                            set: search.set, 
                            class : search.class, 
                            rarity : undefined, 
                            standard : search.isStd
                        })" 
                        ng-class="search.rarity === undefinded ? 'btn-u-sea' : ''">
                        ALL
                    </a>
                </div>
            </div>
            <div class="col-sm-4 col-xs-3" data-ng-repeat="(searchTerm, name) in cardAttributes.rarities">
                <div class="margin-bottom-15">
                    <a class="btn-u" style="width:100;" ui-sref="filter({
                            page : undefined, 
                            type : search.type, 
                            set: search.set, 
                            class : search.class, 
                            rarity : searchTerm, 
                            standard : search.isStd
                        })" 
                        ng-class="search.rarity === searchTerm ? 'btn-u-sea' : ''">
                        @{{ name }}
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Classes</h3>
            </div>
            <div class="col-sm-4 col-xs-3">
                <div class="margin-bottom-15">
                    <a class="btn-u btn-u-green" style="width:100;" ui-sref="filter({
                            page : undefined, 
                            type : search.type, 
                            set: search.set, 
                            class : undefined, 
                            rarity : search.rarity, 
                            standard : search.isStd
                        })" 
                        ng-class="search.class === undefinded ? 'btn-u-sea' : ''">
                        ALL
                    </a>
                </div>
            </div>
            <div class="col-sm-4 col-xs-3" data-ng-repeat="(searchTerm, name) in cardAttributes.classes">
                <div class="margin-bottom-15">
                    <a class="btn-u" style="width:100;" ui-sref="filter({
                            page : undefined, 
                            type : search.type, 
                            set: search.set, 
                            class : searchTerm, 
                            rarity : search.rarity, 
                            standard : search.isStd
                        })" 
                        ng-class="search.class === searchTerm ? 'btn-u-sea' : ''">
                        @{{ name }}
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Sets</h3>
            </div>
            <div class="col-sm-4 col-xs-3">
                <div class="margin-bottom-15">
                    <a class="btn-u btn-u-green" style="width:100;" ui-sref="filter({
                            page : undefined, 
                            type : search.type, 
                            set: undefined, 
                            class : search.class, 
                            rarity : search.rarity, 
                            standard : search.isStd
                        })" 
                        ng-class="search.set === undefinded ? 'btn-u-sea' : ''">
                        ALL
                    </a>
                </div>
            </div>
            <div class="col-sm-4 col-xs-3" data-ng-repeat="(searchTerm, name) in cardAttributes.sets">
                <div class="margin-bottom-15">
                    <a class="btn-u" style="width:100;" ui-sref="filter({
                            page : undefined, 
                            type : search.type, 
                            set: searchTerm, 
                            class : search.class, 
                            rarity : search.rarity, 
                            standard : search.isStd
                        })" 
                        ng-class="search.set === searchTerm ? 'btn-u-sea' : ''">
                        @{{ name }}
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Types</h3>
            </div>
            <div class="col-sm-4 col-xs-3">
                <div class="margin-bottom-15">
                    <a class="btn-u btn-u-green" style="width:100;" ui-sref="filter({
                            page : undefined, 
                            type : undefined, 
                            set: search.set, 
                            class : search.class, 
                            rarity : search.rarity, 
                            standard : search.isStd
                        })" 
                        ng-class="search.type === undefinded ? 'btn-u-sea' : ''">
                        ALL
                    </a>
                </div>
            </div>
            <div class="col-sm-4 col-xs-3" data-ng-repeat="(searchTerm, name) in cardAttributes.types">
                <div class="margin-bottom-15">
                    <a class="btn-u" style="width:100;" ui-sref="filter({
                            page : undefined, 
                            type : searchTerm, 
                            set: search.set, 
                            class : search.class, 
                            rarity : search.rarity, 
                            standard : search.isStd
                        })" 
                        ng-class="search.type === searchTerm ? 'btn-u-sea' : ''">
                        @{{ name }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-sm-3 col-xs-6" data-ng-repeat="card in filteredCards | orderBy:'name' | limitTo : limit : limitFrom">
                <img title="@{{ card.name }}" class="img-responsive" ng-src="@{{ card.image_path }}">
            </div>
        </div>
        <div class="row" ng-if="pagination.lastPage > 1">
            <div class="col-md-12">
                <div class="pagination-div">
                 
                 <ul class="pagination">
                  
                  <li>
                  
                  <a ui-sref="filter({
                            page : (pagination.currentPage > 1) ? (pagination.currentPage - 1) : 1, 
                            type : searchTerm, 
                            set: search.set, 
                            class : search.class, 
                            rarity : search.rarity, 
                            standard : search.isStd
                        })"> Prev</a>
                  
                  </li>
                  
                  <li data-ng-repeat="page in getPaginationPages()" ng-class="pagination.currentPage == page ? 'active' : ''">
                  
                  <a ui-sref="filter({
                            page : page, 
                            type : searchTerm, 
                            set: search.set, 
                            class : search.class, 
                            rarity : search.rarity, 
                            standard : search.isStd
                        })">@{{ page }}</a>
                  
                  </li>
                  
                  <li>
                  
                  <a ui-sref="filter({
                            page : (pagination.currentPage < pagination.lastPage) ? (pagination.currentPage + 1) : pagination.lastPage, 
                            type : searchTerm, 
                            set: search.set, 
                            class : search.class, 
                            rarity : search.rarity, 
                            standard : search.isStd
                        })">Next </a>
                  
                  </li>
                 
                 </ul>

                </div>
            </div>
        </div>
    </div>
</div>