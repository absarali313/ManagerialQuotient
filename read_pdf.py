import PyPDF2

with open('MQ_Final_Full_Document.pdf', 'rb') as file:
    reader = PyPDF2.PdfReader(file)
    text = ""
    for page in reader.pages:
        text += page.extract_text() + "\n"

with open('mq_doc.txt', 'w', encoding='utf-8') as file:
    file.write(text)
