/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControles, RichText } from '@wordpress/block-editor';
import { PanelBody, ColorPalette } from '@wordpress/components';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
const Edit = (props) => {
    const { attributes, setAttributes } = props;
    const { content, backgroundColor, borderColor } = attributes;
	
	// reverse text
	const reverseText = (text) => {
        return text.split('').reverse().join('');
    };

	return (
		<div {...useBlockProps()}>
             <InspectorControls>
                <PanelBody title={__('Block Settings', 'simpli-wp-test-interview')}>
                    <label>{__('Background Color', 'simpli-wp-test-interview')}</label>
                    <ColorPalette
                        value={backgroundColor}
                        onChange={(color) => setAttributes({ backgroundColor: color })}
                    />
                    <label>{__('Border Color', 'simpli-wp-test-interview')}</label>
                    <ColorPalette
                        value={borderColor}
                        onChange={(color) => setAttributes({ borderColor: color })}
                    />
                </PanelBody>
            </InspectorControls>
			<div className="hello-world-block"
                style={{
                    backgroundColor: backgroundColor || 'transparent',
                    borderColor: borderColor || 'transparent',
                    borderStyle: borderColor ? 'solid' : 'none',
                }}
            >
			<RichText
                tagName="p"
				value={content}
				onChange={(newContent) => setAttributes({ content: newContent })}
				placeholder={__('Hello World !', 'simpli-wp-test-interview')}
            />
            </div>
        </div>
	);
}

export default Edit;
