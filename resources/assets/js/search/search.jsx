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
import {connectMenu} from 'react-instantsearch/connectors';
import {orderBy} from 'lodash';

const VirtualMenu = connectMenu(() => null);

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
            <strong>Publicación</strong>
            <RefinementList
                attributeName={"publication_name"}
                showMore={true}
                translations={{showMore: 'Mostrar más'}}
                transformItems={items => orderBy(items, ['label'], ['asc'])}/>
            <DayMenu/>
        </Panel>
    </div>

const DayMenu = () => {
    if (config.defaultRefinementDay) {
        return <VirtualMenu attributeName="date" defaultRefinement={config.defaultRefinementDay}/>
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

    var title = <ResultsHeader/>
    return <div className="content">
        <Panel header={title}>
            <Hits hitComponent={Hit}/>
            <Pagination/>
        </Panel>
    </div>;
}

function Search(props) {
    if (config.defaultRefinementSearch) {
        return <SearchBox autoFocus={true} onChange={props.onSearch} translations={{placeholder: ""}}
                          defaultRefinement={config.defaultRefinementSearch}/>;
    } else {
        return <SearchBox autoFocus={true} onChange={props.onSearch} translations={{placeholder: ""}}/>;
    }
}

function CreateAlert(props) {
    var url = "/alerts/create?query=" + props.query;
    return <a href={url}>Convertir búsqueda en alerta.</a>;
}

const SearchHelp = () => {
    if (config.defaultRefinementSearch !== null) {
        return null;
    }
    return <div className="help-block"><p>Puedes buscar nombres, direcciones, empresas. Ejemplo: 75724470, "Maria Peña", Calle
        Gran Via, ...</p></div>
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
        return <div>
            <SearchHelp/>
            <Search onSearch={this.onSearch}/>
            <ResultResume query={this.state.query}/>
        </div>
    }
}

class ResultResume extends React.Component {
    render() {
        return <p>
            {this.props.query.length > 0 &&
            <Counter/>
            }
            {this.props.query.length > 0 && this.props.query !== config.defaultRefinementSearch &&
            <CreateAlert query={this.props.query}/>
            }
        </p>
    }
}

const
    Results = () =>
        <div>
            <div className="col-md-4">
                <Sidebar/>
            </div>
            <div className="col-md-8">
                <Content/>
            </div>
        </div>

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

