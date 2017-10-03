import React from 'react';
import ReactDOM from 'react-dom';
import {
	InstantSearch,
	Configure,
	SearchBox,
	Hits,
	Highlight,
	Snippet,
	Menu,
	VirtualMenu,
	CurrentRefinements,
	RefinementList,
	Pagination,
	Stats
} from 'react-instantsearch/dom'
import { Panel } from 'react-bootstrap';

const Hit = ({hit}) => {
	var url = "/storage/" + hit.filename;
	return <div className="hit panel panel-default panel-body">
		<a href={url} target="_blank" className="btn btn-default pull-right">
			<i className="glyphicon glyphicon-download"></i> Descargar PDF</a>
		<div>
			<strong>{hit.publication_name}</strong>
			<div>{hit.day}</div>
			<i><Snippet attributeName="content" hit={hit} tagName="i" /></i>
		</div>
	</div>
}

const Sidebar = () =>
	<div className="sidebar">
		<Panel header="Filtros">
			<strong>Publicación</strong>
			<RefinementList attributeName={"publication_name"}/>
			<strong>Día</strong>
			<DayMenu/>
		</Panel>
	</div>

const DayMenu = () => {
	if (config.defaultRefinementDay) {
		return <Menu attributeName={"day"} defaultRefinement={config.defaultRefinementDay}/>
	} else {
		return <Menu attributeName={"day"}/>
	}
}

const Content = () =>
	<div className="content">
		<Panel header="Resultados">
			<Hits hitComponent={Hit}/>
			<Pagination/>
		</Panel>
	</div>

const Search = () => {
	if (config.defaultRefinementSearch) {
        return <SearchBox translation={{placeholder:"Buscar"}} defaultRefinement={config.defaultRefinementSearch}/>;
	} else {
        return <SearchBox translation={{placeholder:"Buscar"}}/>;
	}
}

ReactDOM.render(
	<InstantSearch
		apiKey={config.apiKey}
		appId={config.appId}
		indexName={config.indexId}
	>
		<Configure facetingAfterDistinct ={true}/>

		<div className="col-md-12">
			<Panel header="Buscar">
				<Search/>
				<div>
					<Stats />
				</div>
			</Panel>
		</div>
		<div className="col-md-4">
			<Sidebar/>
		</div>
		<div className="col-md-8">
			<Content/>
		</div>
	</InstantSearch>,
	document.getElementById('root')
);

