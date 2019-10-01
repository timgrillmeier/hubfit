module.exports = {
    'extends': 'stylelint-config-standard',
    'rules': {
        'indentation': 4,
        'no-empty-source': null,
        'string-quotes': 'single',
        'max-empty-lines': [2, {
            ignore: ["comments"]
        }],
        'no-descending-specificity': null,
        'at-rule-no-unknown': [
            true,
            {
                'ignoreAtRules': [
                    'extend',
                    'at-root',
                    'debug',
                    'warn',
                    'error',
                    'if',
                    'else',
                    'for',
                    'each',
                    'while',
                    'mixin',
                    'include',
                    'content',
                    'return',
                    'function',
                    'tailwind',
                    'apply',
                    'responsive',
                    'variants',
                    'screen',
                ],
            },
        ],
    },
};
