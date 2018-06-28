# noinspection PyInterpreter
file_name = input('Filename: ')
file = open('./assets/js/{}.js'.format(file_name), 'r').read()

lines = file.splitlines()

for line in lines:
    if not line.startswith('/*') and not line.startswith('import highlight') and not line.startswith('highlight.r'):
        words = line.split()
        if words:
            keyword = words[1]
            print("highlight.registerLanguage('{}', {})".format(keyword, keyword))