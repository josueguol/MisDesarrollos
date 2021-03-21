import React, { Component } from 'react'

import { SearchForm } from './SearchForm'

export class Search extends Component {
    static displayName = Search.name

    state = { searchResults: [] }

    _handleResults = (results) => {
        this.setState({ searchResults: results })
    }

    _handleClick = (e) => {
        console.log(e.target.dataset.link)

        fetch('/api/views', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                idNoticia: parseInt(e.target.dataset.id),
                idBusqueda: parseInt(e.target.dataset.idbusqueda), 
                link: e.target.dataset.link
            })
        })
        .then(response => {
            if (response.ok) {
                console.log(response)
            }
        })

        fetch('/api/behavior', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                idNoticia: parseInt(e.target.dataset.id),
                token: "abc123"
            })
        })
        .then(response => {
            if (response.ok) {
                console.log(response)
            }
        })
    }

    _renderResults() {
        const { searchResults } = this.state
        return searchResults.map(result => {
            return (
                <div className="box" key={result.id}>
                    <article className="media">
                        <div className="media-content">
                            <div className="content">
                                <p>
                                    <strong>{result.titulo}</strong> <small>{result.fechaPublicacion}</small> <small>{result.tipo}</small>
                                    <br />
                                    {result.extracto}
                                </p>
                                <button
                                    className="button is-info"
                                    type="button"
                                    data-id={result.id}
                                    data-idbusqueda={result.idBusqueda}
                                    data-link={result.link}
                                    onClick={this._handleClick}
                                >Trend!</button>
                            </div>
                        </div>
                    </article>
                </div>
            )
        })
    }

    render() {
        return (
            <>
                <div className="SearchForm-wrapper">
                    <SearchForm onResults={this._handleResults} />
                </div>

                <hr />
                <div className="row">
                    {
                        this.state.searchResults.length > 0
                        ? this._renderResults()
                        : <p>Realiza una búsqueda para mostrar contenido...</p>
                    }
                </div>
            </>
        );
    }
}
