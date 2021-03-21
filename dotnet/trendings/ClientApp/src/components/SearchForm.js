import React, { Component } from 'react'

export class SearchForm extends Component {

    _handleChange = (e) => {
        this.setState({ inputSearch: e.target.value })
    }

    _handleSubmit = (e) => {
        e.preventDefault()

        const { inputSearch } = this.state

        fetch('/api/search', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ phrase: inputSearch })
        })
        .then(response => response.json())
        .then(json => {
            console.log(json)
            this.props.onResults(json)
        })
    }

    render() {

        return (
            <form onSubmit={this._handleSubmit}>
                <div className="field has-addons">
                    <div className="control">
                        <input
                            className="input"
                            onChange={this._handleChange}
                            type="text"
                            placeholder="Tema de búsqueda" />
                    </div>
                    <div className="control">
                        <button className="button is-info" type="submit">
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
        )
    }
}