import React, { Component } from 'react'


export class Content extends Component {
    static displayName = Content.name

    hasTitle = false
    hasTeaser = false
    hasContent = false
    hasType = false

    state = { NoticiaImportante: false }

    _handleTitle = (e) => {
        this.hasTitle = e.target.value.length > 2
        this.setState({ Titulo: e.target.value })
    }
    
    _handleTeaser = (e) => {
        this.hasTeaser = e.target.value.length > 2
        this.setState({ Extracto: e.target.value })
    }
    
    _handleContent = (e) => {
        this.hasContent = e.target.value.length > 2
        this.setState({ Contenido: e.target.value })
    }
    
    _handleBreakingNews = (e) => {
        this.setState({ NoticiaImportante: e.target.checked })
    }
    
    _handleType = (e) => {
        this.hasType = e.target.value !== "Selecciona tipo"
        this.setState({ Tipo: e.target.value })
    }

    _handleSubmit = (e) => {
        e.preventDefault()

        if (!(this.hasTitle && this.hasTeaser && this.hasContent && this.hasType)) {
            alert("Campos sin llenar o no cumplen con los requisitos mínimos");
            return 
        }

        const { Titulo, Extracto, Contenido, NoticiaImportante, Tipo } = this.state
        const today = new Date()
        const year = today.getFullYear()
        const month = today.getMonth()
        const day = today.getDay()
        const hours = today.getHours()
        const minutes = today.getMinutes()
        const seconds = today.getSeconds()
        const FechaPublicacion = `${year}-${month < 10 ? '0' + month : month}-${day < 10 ? '0' + day : day}T${hours < 10 ? '0' + hours : hours}:${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`
        fetch('/api/entry', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ Titulo, Extracto, Contenido, NoticiaImportante, FechaPublicacion, Tipo })
        })
        .then(response => {
            if (response.ok) {
                console.log(response)
                this._handleReset()
            }
        })
    }

    _handleReset = () => {
        this.myFormRef.reset();
    }

    render() {
        return(
            <>
                <form onSubmit={this._handleSubmit} ref={(el) => this.myFormRef = el}>
                    <div className="field">
                        <label className="label">Titulo</label>
                        <div className="control">
                            <input
                                className="input"
                                type="text"
                                placeholder="Título"
                                onChange={this._handleTitle}
                            />
                        </div>
                    </div>
                    <div className="field">
                        <label className="label">Extracto</label>
                        <div className="control">
                            <input
                                className="input"
                                type="text"
                                placeholder="Extracto"
                                onChange={this._handleTeaser}
                            />
                        </div>
                    </div>
                    <div className="field">
                        <label className="label">Contenido</label>
                        <div className="control">
                            <textarea
                                className="textarea"
                                placeholder="Contenido"
                                onChange={this._handleContent}
                            ></textarea>
                        </div>
                    </div>
                    <div className="field">
                        <div className="control">
                            <label className="checkbox">
                            <input
                                type="checkbox"
                                onChange={this._handleBreakingNews}
                            />
                                Noticia de último momento
                            </label>
                        </div>
                    </div>
                    <div className="field">
                        <label className="label">Tipo de contenido</label>
                        <div className="control">
                            <div className="select">
                                <select
                                    onChange={this._handleType}
                                >
                                    <option>Selecciona tipo</option>
                                    <option>nota</option>
                                    <option>video</option>
                                    <option>galeria</option>
                                    <option>infografia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div className="field is-grouped">
                        <div className="control">
                            <button className="button is-link" type="submit">Guardar</button>
                        </div>
                        <div className="control">
                            <button
                                className="button is-link is-light"
                                type="reset"
                                onClick={this._handleReset}
                            >Borrar</button>
                        </div>
                    </div>
                </form>
            </>
        )
    }
}