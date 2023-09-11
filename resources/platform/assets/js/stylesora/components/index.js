const containers = require('./_containers');
const fluidType = require('./_fluidTypography');
const buttons = require('./_buttons');
const forms = require('./_forms');
const tooltips = require('./_tooltips');
const lists = require('./_lists');
const cards = require('./_cards');
const modals = require('./_modals');

module.exports = () => {
    return function({ theme, addComponents }) {
        const stylesoraComponents = [
            containers(theme),
            fluidType(theme),
            buttons(theme),
            forms(theme),
            tooltips(theme),
            lists(theme),
            cards(theme),
            modals(theme),
        ];

        addComponents(stylesoraComponents);
    }
}