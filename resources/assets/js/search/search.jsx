import React from 'react';
import ReactDOM from 'react-dom';
import {
    InstantSearch,
    Configure,
    SearchBox,
    Hits,
    Snippet,
    Menu,
    RefinementList,
    Pagination,
    Stats
} from 'react-instantsearch/dom'
import {Panel} from 'react-bootstrap';
import {connectRefinementList} from 'react-instantsearch/connectors';
import {orderBy} from 'lodash';
import "./search.css";
import mobile from "is-mobile";

const VirtualMenu = connectRefinementList(() => null);

const Hit = ({hit}) =>
    <div className="hit panel panel-default panel-body">
        <a href={hit.url} target="_blank" className="btn btn-default pull-right">
            <i className="glyphicon glyphicon-download"></i> Descargar PDF</a>
        <div>
            <strong>{hit.publication_name}</strong>
            <div>{hit.day}</div>
            <i><Snippet attributeName="content" hit={hit} tagName="i"/></i>
        </div>
    </div>


const Sidebar = () =>
    <div className="sidebar">
        <Panel header="Filtros">
            <PublicationsMenu/>
            <DayMenu/>
        </Panel>
    </div>

const PublicationsMenu = () => {
	if (config.defaultRefinementPublications) {
		return <VirtualMenu attributeName="publication_name" defaultRefinement={config.defaultRefinementPublications}/>
	} else {
		return <div>
            <strong>Publicación</strong>
            <RefinementList
			attributeName={"publication_name"}
			showMore={true}
			translations={{showMore: 'Mostrar más'}}
			transformItems={items => orderBy(items, ['label'], ['asc'])}/>
		</div>
	}
};

const DayMenu = () => {
    if (config.defaultRefinementDays) {
        return <VirtualMenu attributeName="date" defaultRefinement={config.defaultRefinementDays}/>
    } else {
        return (<div>
            <strong>Día</strong>
            <RefinementList
                attributeName={"date"}
                translations={{showMore: 'Mostrar más'}}
                showMore={true}
                transformItems={items => orderBy(items, ['label'], ['desc'])}/>
        </div>);
    }
}

const Counter = () => <Stats
    translations={{stats: (n, t) => n + " resultados encontrados en " + t + "ms. "}}/>;

const ResultsHeader = () =>
    <div>
        Resultados
    </div>

const Content = () => {

	if (mobile()) {
	    return <div>
		    <Hits hitComponent={Hit}/>
		    <Pagination/>
        </div>
	}

    const title = <ResultsHeader/>
    return <div className="content">
        <Panel header={title}>
            <Hits hitComponent={Hit}/>
            <Pagination/>
        </Panel>
    </div>;
}

const scrollToSearchInput = () => {
  document.getElementById('searchbox-container').scrollIntoView();
  document.getElementsByClassName("ais-SearchBox__input")[0].focus();
};

function Search(props) {
    const onFocus = () => mobile() && scrollToSearchInput();

    if (config.defaultRefinementSearch) {
        return <SearchBox id="searchbox" onFocus={onFocus} autoFocus={true} onChange={props.onSearch} translations={{placeholder: ""}}
                          defaultRefinement={config.defaultRefinementSearch}/>;
    } else {
        return <SearchBox id="searchbox" onFocus={onFocus} autoFocus={true} onChange={props.onSearch} translations={{placeholder: ""}}/>;
    }
}

function CreateAlert(props) {
    var url = "/alertas?query=" + encodeURI(props.query);
    return <a id="call-to-action" href={url} className="btn btn-primary">Crear alerta diaria</a>;
}

const SearchHelp = () => {
    if (config.defaultRefinementSearch !== null) {
        return null;
    }
    return <div className="help-block"><p>Puedes buscar oposiciones, nombres, direcciones, empresas. Ejemplo: 75714470, "Maria Peña", "energias renovables", ...</p></div>
}

class SearchPanel extends React.Component {


    constructor() {
        super();
        this.state = {
            query: '',
        };
        this.onSearch = this.onSearch.bind(this);
    }

    onSearch(event) {
        var value = event.target.value;
        this.props.setSearched(value.length > 0);
        this.setState({query: value});
    }

    render() {
	    const state = this.state;
	    const query = state.query;
	    const userEnterNewQuery = query.length > 0 && !config.existingAlerts.some(a => a === query);
	    const defaultQueryNotAlert = config.defaultRefinementSearch && !config.existingAlerts.some(a => a === query)
	    const shouldShowAlert = userEnterNewQuery || defaultQueryNotAlert;
	    return <div>
            <SearchHelp/>
            <div id="searchbox-container">
                <Search onSearch={this.onSearch}/>
                { shouldShowAlert &&
                    <CreateAlert query={query || config.defaultRefinementSearch}/>
                }
            </div>
            <ResultResume query={query}/>
        </div>
    }
}

function Suggestion(props) {
	if(props.query[0] === "\"" || props.query[props.query.length -1 ] === "\"" || !props.query.includes(" ")) return null;

	return <div className="alert alert-warning">Consejo. Puedes entrecomillar {props.query} para buscar concondarcias exactas.</div>
}

class ResultResume extends React.Component {
    render() {
        return <div><p>
            {this.props.query.length > 0 &&
            <Counter/>
            }
        </p>
	        {this.props.query.length > 0 && this.props.query !== config.defaultRefinementSearch &&
	            <Suggestion query={this.props.query}/>
	        }
        </div>
    }
}

const Results = () => {
    return <div>
        <div className="col-md-4 hidden-xs">
          <Sidebar/>
        </div>
        <div className="col-md-8">
          <Content/>
        </div>
      </div>
}

class Main
    extends React
        .Component {

    constructor() {
        super();
        this.state = {
            searched: false,
        };
        this.setSearched = this.setSearched.bind(this);
    }

    setSearched(searched) {
        this.setState({searched: searched});
    }

    render() {
        return <InstantSearch
            apiKey={config.apiKey}
            appId={config.appId}
            indexName={config.indexId}
        >
            <Configure facetingAfterDistinct={true}/>

            <div className="col-md-12">
                <SearchPanel setSearched={this.setSearched}
                             showStats={(config.initWithResults || this.state.searched)}/>
            </div>
            {(config.initWithResults || this.state.searched) &&
            <Results/>
            }

        </InstantSearch>;
    }
}

ReactDOM.render(<Main/>, document.getElementById('root'));

