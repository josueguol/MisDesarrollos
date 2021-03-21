const { registerBlockType } = wp.blocks;
const { withSelect } = wp.data;
const { RichText, InspectorControls } = wp.blockEditor;
const { PanelBody, RangeControl, SelectControl } = wp.components;

import { ReactComponent as LogoJob } from '../imagetext.svg';

registerBlockType('keicel/jobs', {
    title: 'Trabajos',
    icon: { src: LogoJob },
    category: 'keicel',
    attributes: {
        cantidadMostrar: {
            type: 'number',
            default: 4
        },
        categoriaTrabajo: {
            type: 'number'
        }
    },
    edit: withSelect( (select, props)=> {

        const { attributes: { cantidadMostrar, categoriaTrabajo }, setAttributes } = props;
        const onChangeCantidadMostrar = cantidad => {
            setAttributes({ cantidadMostrar: parseInt(cantidad) });
        };

        const onChangeCategoriaTrabajo = categoria => {
            setAttributes({ categoriaTrabajo: categoria });
        }

        return {
            categorias: select("core").getEntityRecords('taxonomy', 'categoria-trabajo'),
            jobs: select("core").getEntityRecords('postType', 'jobs', {
                'categoria-trabajo': categoriaTrabajo,
                per_page: cantidadMostrar
            }),
            onChangeCantidadMostrar,
            onChangeCategoriaTrabajo,
            props
        };
    })
    
    ( ({ categorias, jobs, onChangeCantidadMostrar, onChangeCategoriaTrabajo, props }) => {
        console.log(categorias);

        if(!jobs) {
            return 'Cargando...';
        }
        if(jobs && jobs.length === 0) {
            return 'Sin resultados';
        }

        if(!categorias) {
            console.log('Cargando...');
        }
        if(categorias && categorias.length === 0) {
            console.log('Sin resultados');
        }

        categorias.forEach( categoria => {
            categoria['label'] = categoria.name;
            categoria['value'] = categoria.id;
        });

        const categoriaDefault = [ { label: ' -- TODOS -- ', value: '' } ];

        const todasCategorias = [ ...categoriaDefault, ...categorias ];

        const { attributes: { cantidadMostrar, categoriaTrabajo } } = props;

        return(
            <>
                <InspectorControls>
                    <PanelBody
                        title={ 'Cantidad a mostrar' }
                        initialOpen={ true }
                    >
                        <div className="components-base-control">
                            <div className="components-base-control__field">
                                <labe className="components-base-control__label">
                                    Cantidad a mostrar
                                </labe>
                                <RangeControl
                                    onChange={onChangeCantidadMostrar}
                                    min={2}
                                    max={10}
                                    value={cantidadMostrar}
                                />
                            </div>
                        </div>
                    </PanelBody>
                    <PanelBody
                        title={ 'Categoria de trabajo' }
                        initialOpen={ true }
                    >
                        <div className="components-base-control">
                            <div className="components-base-control__field">
                                <labe className="components-base-control__label">
                                    Categoria de trabajo
                                </labe>
                                <SelectControl
                                    options={todasCategorias}
                                    onChange={onChangeCategoriaTrabajo}
                                    value={categoriaTrabajo}
                                />
                            </div>
                        </div>
                    </PanelBody>
                </InspectorControls>
                <h2 className="titulo-ofertas">Nuestras ofertas de trabajo</h2>
                <ul className="trabajo-ofertas">
                    { jobs.map( trabajo => (
                        <li>
                            <img src={trabajo.imagen_destacada}/>
                            <div className="titulo-trabajo">
                                <div>
                                    <h3>{trabajo.title.raw}</h3>

                                    <p>Sueldo: $ {trabajo.sueldo_bruto}</p>
                                </div>
                            </div>
                            <div className="contenido-trabajo">
                                <p>
                                    <RichText.Content
                                        value={trabajo.content.rendered.substring(0, 180)}/>
                                </p>
                            </div>
                        </li>
                    ))}
                </ul>
            </>
        );
    }),
    save: () => {
        return null;
    }
})