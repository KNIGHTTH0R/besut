# import StemmerFactory class
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory
import sys
import math

sentence = ''
for word in sys.argv[1:]:
	sentence += word + ' '
	
#print sentence

# create stemmer
factoryStemmer = StemmerFactory()
stemmer = factoryStemmer.create_stemmer()

factoryStopWord = StopWordRemoverFactory()
stopword = factoryStopWord.create_stop_word_remover()

# stemming process
#sentence = 'Perekonomian Indonesia sedang dalam pertumbuhan yang membanggakan'
sentence = stemmer.stem(sentence)
output   = stopword.remove(sentence)

print(output)
# ekonomi indonesia sedang dalam tumbuh yang bangga

#print(stemmer.stem('Mereka meniru-nirukannya'))
# mereka tiru