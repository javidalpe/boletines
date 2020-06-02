import 'react-app-polyfill/ie9';
import '../polyfill/includes';
import React from 'react';
import ReactDOM from 'react-dom';
import {
  InstantSearch,
  Configure,
  SearchBox,
  Hits,
  Snippet,
  RefinementList,
  Pagination,
  Stats
} from 'react-instantsearch/dom'
import { connectRefinementList } from 'react-instantsearch/connectors';
import "./search.css";
import mobile from "is-mobile";

const VirtualMenu = connectRefinementList(() => null);

let timeout = null;
const debounce = (func, time) => {
  if (timeout) {
    clearTimeout(timeout);
  }
  timeout = setTimeout(func, time);
};

const Panel = props => <div className="panel panel-default">
  <div className="panel-heading">
    <div>{props.header}</div>
  </div>
  <div className="panel-body">{props.children}</div>
</div>

const Hit = ({hit}) =>
  <div className="hit panel panel-default panel-body">
    <a href={hit.url} target="_blank" rel="noopener noreferrer" className="btn btn-default pull-right">Descargar PDF</a>
    <div>
      <strong>{hit.publication_name}</strong>
      <div>{hit.day}</div>
        <div style={styles.result}>
            <i>
                <Snippet attributeName="content" hit={hit} tagName="i"/>
            </i>
        </div>
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
        limitMin={10}
        limitMax={65}
        translations={{showMore: expanded => expanded ? 'Mostrar menos' : 'Mostrar mas'}}
        transformItems={items => items.sort((a, b) => {
          if (a.label > b.label) {
            return 1;
          }
          if (a.label < b.label) {
            return -1;
          }
          return 0;
        })}
      />
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
        translations={{showMore: expanded => expanded ? 'Mostrar menos' : 'Mostrar mas'}}
        showMore={true}
        limitMin={10}
        limitMax={30}
      />
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
    return <SearchBox id="searchbox" name="search" onFocus={onFocus} autoFocus={true} onChange={props.onSearch}
                      translations={{placeholder: ""}}
                      defaultRefinement={config.defaultRefinementSearch}/>;
  } else {
    return <SearchBox id="searchbox" name="search" onFocus={onFocus} autoFocus={true} onChange={props.onSearch}
                      translations={{placeholder: ""}}/>;
  }
}

function CreateAlert(props) {
  var url = "/alertas?query=" + encodeURI(props.query);
  return <a id="call-to-action" href={url} className="btn btn-primary">Crear alerta diaria</a>;
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

    if (window.ga === undefined) {
      return;
    }

    debounce(() => ga('send', 'event', 'Search', 'search', value), 200);
  }

  render() {
    const state = this.state;
    const query = state.query;
    const userEnterNewQuery = query.length > 0 && !config.existingAlerts.some(a => a === query);
    const defaultQueryNotAlert = config.defaultRefinementSearch && !config.existingAlerts.some(a => a === query)
    const shouldShowAlert = userEnterNewQuery || defaultQueryNotAlert;
    return <div>
      <div id="searchbox-container">
          <label htmlFor="search" style={{display: "none"}}>Introduce un término</label><Search onSearch={this.onSearch}/>
        {shouldShowAlert &&
        <CreateAlert query={query || config.defaultRefinementSearch}/>
        }
      </div>
      <ResultResume query={query}/>
    </div>
  }
}

function Suggestion(props) {
  if (props.query[0] === "\"" || props.query[props.query.length - 1] === "\"" || !props.query.includes(" ")) return null;

  return <div className="alert alert-warning">Consejo. Puedes entrecomillar {props.query} para buscar concordancias.
    exactas.</div>
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

const styles = {
    result: {
        overflow: "hidden",
        textOverflow: "ellipsis"
    }
}

