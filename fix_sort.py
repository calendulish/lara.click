#!/usr/bin/env python

from os import system
from time import sleep

posts = {
    'Animes': 201812200000,
    'Dor': 201901070000,
    'Coisas': 201902160000,
    'Big Bang': 201901300000,
    'Quem sou eu': 201902150000,
    'Professora': 201901290000,
    'O Tempo': 201902060000,
    'Ódio Falso': 201901110000,
    'Natal': 201812260000,
    'Insônia': 201901180000,
    'Formigas': 201902130000,
}

print("Please wait...", end='\r');

for post, date in posts.items():
    system(f'touch -a -m -t {date} "blog/pt_BR/{post}.post"')
    sleep(0.3)

print("Done.", 10*' ');