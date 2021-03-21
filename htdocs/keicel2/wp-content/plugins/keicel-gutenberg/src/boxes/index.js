const { registerBlockType } = wp.blocks;
const { RichText, InspectorControls, ColorPalette, MediaUpload } = wp.blockEditor;
const { PanelBody, IconButton } = wp.components;

// Logo para el bloque
import { ReactComponent as Logo } from '../header.svg';

/**
 * 7 pasos para crear un bloque en Gutenberg
 * 1.- Colaca el componente que utilizarás
 * 2.- Colocar el componente donde deseas utilizarlo
 * 3.- Crea una funcion que lea los contenidos
 * 4.- Registra un attributo
 * 5.- Extrae el contenido desde props
 * 6.- Guarda el contenido con setAttributes
 * 7.- Lee los contenidos guardados en save()
 */
registerBlockType('keicel/boxes', {
    title: 'Keicel Imagen Cabecera',
    icon: { src: Logo },
    category: 'keicel',
    attributes: {
        headingBox : {
            type: 'string',
            source: 'html',
            selector: '.box h2'
        },
        descriptionBox: {
            type: 'string',
            source: 'html',
            selector: '.box p'
        },
        colorFuente: {
            type: 'string'
        },
        imagenes: {
            type: 'object'
        }
    },
    edit: props => {

        console.log( props );

        const { attributes: { headingBox, descriptionBox, colorFuente, imagenes = {} }, setAttributes } = props;

        const onChangeHeadingBox = heading => {
            setAttributes( { headingBox: heading });
        }
        const onChangeDescriptionBox = description => {
            setAttributes( { descriptionBox: description });
        }
        const onChangeColorFuente = fuente => {
            setAttributes( { colorFuente: fuente });
        }
        const onSelectImage = imagenSeleccion => {
            const images = {
                large: imagenSeleccion.sizes.large.url,
                full: imagenSeleccion.sizes.full.url,
                id: imagenSeleccion.id
            }
            
            setAttributes( { imagenes: images });
        }

        return(
            <>
                <InspectorControls>
                    <PanelBody
                        title={ 'Color de fondo' }
                        initialOpen={ true }
                    >
                        <div className="components-base-control">
                            <div className="components-base-control__field">
                                <labe className="components-base-control__label">
                                    Color de fuente
                                </labe>
                                <ColorPalette 
                                    onChange={ onChangeColorFuente }
                                    value={ colorFuente }
                                />
                            </div>
                        </div>
                    </PanelBody>
                </InspectorControls>
                <div className="box hero" style={{ color : colorFuente, backgroundImage: `url(${imagenes.large})` }}>
                    <div className="keicel-imagen-fondo">
                        <MediaUpload
                            onSelect={ onSelectImage }
                            type="image"
                            render={ ( { open } ) => (
                                <IconButton
                                    className="keicel-agregar-imagen"
                                    onClick={ open }
                                    icon="format-image"
                                    showTooltip="true"
                                    label="Usar Imagen"
                                />
                            )}
                        />
                    </div>
                    <h2>
                        <RichText
                            placeholder="Texto principal"
                            onChange={onChangeHeadingBox}
                            value={headingBox}
                        />
                    </h2>
                    <p>
                        <RichText
                            placeholder="Descripción"
                            onChange={onChangeDescriptionBox}
                            value={descriptionBox}
                        />
                    </p>
                </div>
            </>
        )
    },
    save: (props) => {

        console.log( props );

        const { attributes: { headingBox, descriptionBox, colorFuente, imagenes = {} } } = props;

        return(
            <div className="box hero" style={{ color : colorFuente, backgroundImage: `url(${imagenes.large})` }}>
                <div className="contenido-hero"><h2>
                        <RichText.Content value={headingBox} />
                    </h2>
                    <p>
                        <RichText.Content value={descriptionBox} />
                    </p>
                </div>
            </div>
        )
    }
});