wp.blocks.registerBlockType('brad/border-box', {
    title: 'My Cool Border Box',
    icon: 'smiley',
    category: 'common',
    attributes: {
        content: {type: 'string'},
        color: {type: 'string'},
    },
    edit: function(props) {
        function updateContent(event) {
            props.setAttributes({
                content: event.target.value
            });
        }
        function updateColor(value) {
            props.setAttributes({
                color: value.hex
            });
        }
        //swap out wp.element for React
        return wp.element.createElement("div", null, /*#__PURE__*/wp.element.createElement("h3", null, "Your cool border box"), /*#__PURE__*/wp.element.createElement("input", {
          type: "text",
          onChange: updateContent,
          value: props.attributes.content
        }), /*#__PURE__*/wp.element.createElement(wp.components.ColorPicker, {
          onChangeComplete: updateColor,
          color: props.attributes.color
        }));
    },
    save: function(props) {
        return wp.element.createElement("h3", {
            style: {
              border: `5px solid ${props.attributes.color}`
            }
          }, props.attributes.content);
    },
});


// general format of a block type
//  wp.blocks.registerBlockType('namespace/blockname', {
//     title: '',
//     icon: '',
//     category: '',
//     attributes: '',
//     edit: '',
//     save: '',
// });