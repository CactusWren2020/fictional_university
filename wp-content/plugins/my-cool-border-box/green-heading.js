wp.blocks.registerBlockType('mike/sub-heading', {
    title: 'Sub Heading',
    icon: 'welcome-write-blog',
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
                })
        }

        return wp.element.createElement("div", null, /*#__PURE__*/wp.element.createElement("p", null, "Your Custom Subheading"), /*#__PURE__*/wp.element.createElement("input", {
          type: "text",
          onChange: updateContent,
          value: props.attributes.content
        }), /*#__PURE__*/wp.element.createElement(wp.components.ColorPicker, {
          onChangeComplete: updateColor,
          color: props.attributes.color
        }));
    },
    save: function(props) {
        return wp.element.createElement("h2", {
          style: {
            backgroundColor: props.attributes.color
          }
        },
          props.attributes.content);
    },
});