/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './style.scss';

/**
 * Internal dependencies
 */
import Edit from './edit';
import metadata from './block.json';

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType('simpli/hello-world', {
	/**
	 * @see ./edit.js
	 */
	title: 'Hello World', 
	category: 'widgets',
	description: 'Block Gutenberg to display a simple message.',
	supports: {
		html: false,
	},
	// Backend edition :
	edit: (props) => {
		const { attributes, setAttributes } = props;
		const { content } = attributes;
	
		return (
			<div {...useBlockProps()}>
				<InspectorControls>
					<PanelBody title="Block Settings">
						<label>Background Color</label>
						<ColorPalette
							value={backgroundColor}
							onChange={(color) => setAttributes({ backgroundColor: color })}
						/>
						<label>Border Color</label>
						<ColorPalette
							value={borderColor}
							onChange={(color) => setAttributes({ borderColor: color })}
						/>
					</PanelBody>
				</InspectorControls>
				<div
					className="hello-world-block"
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
						placeholder="Hello World!"
					/>
				</div>
			</div>
		)
    },
	// Frontend display :
	save: (props) => {
		const { attributes } = props;
		const { content } = attributes;
		const reversedContent = content ? content.split('').reverse().join('') : 'Hello World';
	
		return (
			<div
				className="hello-world-block"
				// React double accolade ! 
				// For Js object 
				style={{
					backgroundColor: attributes.backgroundColor || 'transparent',
					borderColor: attributes.borderColor || 'transparent',
					borderStyle: attributes.borderColor ? 'solid' : 'none',
				}}
			>
				<p>{reversedContent}</p>
			</div>
		);
	},
	style: 'file:./style.scss',
  });
