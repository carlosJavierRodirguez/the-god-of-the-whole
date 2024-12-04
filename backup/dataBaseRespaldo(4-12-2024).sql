--
-- PostgreSQL database dump
--

-- Dumped from database version 15.8
-- Dumped by pg_dump version 17.1

-- Started on 2024-12-04 17:25:45

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 3393 (class 0 OID 16876)
-- Dependencies: 214
-- Data for Name: imagenPerfil; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."imagenPerfil" (id_url, url_imagen, nombre_imagen) FROM stdin;
1	../img/diosesVerdaderos/afrodita.png	Afrodita
2	../img/diosesVerdaderos/apolo.png	Apolo
3	../img/diosesVerdaderos/zeus.png	Zeus
4	../img/diosesVerdaderos/poseidon.png	Poseidón
5	../img/diosesVerdaderos/ares.png	Ares
6	../img/diosesVerdaderos/artemisa.png	Artemisa
7	../img/diosesVerdaderos/hera.png	Hera
8	../img/diosesVerdaderos/atenea.png	Atenea
9	../img/diosesVerdaderos/hades.png	Hades
10	../img/diosesVerdaderos/hefesto.png	Hefesto
14	../img/criaturasMitologicas/sirenas.png	Sirenas
13	../img/criaturasMitologicas/minotauro.png	Minotauro
12	../img/criaturasMitologicas/griffo.png	Griffo
15	../img/semiDioses/gemini.png	Gemini
\.


--
-- TOC entry 3396 (class 0 OID 16885)
-- Dependencies: 217
-- Data for Name: imagen_pregunta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.imagen_pregunta (pregunta_id, imagen_id) FROM stdin;
1	11
1	12
1	13
1	14
1	15
1	16
1	17
1	18
1	19
1	20
2	1
2	2
2	3
2	4
2	5
2	6
2	7
2	8
2	9
2	10
3	21
3	22
3	23
3	24
3	25
3	26
3	27
3	28
3	29
3	30
4	11
4	12
4	13
4	14
4	15
4	16
4	17
4	18
4	19
4	20
5	31
5	32
5	33
5	34
5	35
5	36
5	37
5	38
5	39
5	40
6	1
6	2
6	3
6	4
6	5
6	6
6	7
6	8
6	9
6	10
\.


--
-- TOC entry 3394 (class 0 OID 16879)
-- Dependencies: 215
-- Data for Name: imagen_url; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.imagen_url (imagen_url, nombre, imagen_id) FROM stdin;
../img/TitanesURL/Titanide.png	Titanide	40
../img/TitanesURL/Temis.png	Temis	39
../img/TitanesURL/Rea.png	Rea	38
../img/TitanesURL/Oceano.png	Oceano	37
../img/TitanesURL/Mnemosine.png	Mnemosine	36
../img/TitanesURL/Lapeto.png	Lapeto	35
../img/TitanesURL/Hiperion.png	Hiperion	34
../img/TitanesURL/Cronos.png	Cronos	33
../img/TitanesURL/Crio.png	Crio	32
../img/TitanesURL/Ceo.png	Ceo	31
../img/semiDiosesURL/Teseo.png	Teseo	30
../img/semiDiosesURL/Perseo.png	Perseo	29
../img/semiDiosesURL/Pan.png	Pan	28
../img/semiDiosesURL/Orfeo.png	Orfeo	27
../img/semiDiosesURL/Hipolito.png	Hipolito	26
../img/semiDiosesURL/Hercules.png	Hercules	25
../img/semiDiosesURL/Helena.png	Helena	24
../img/semiDiosesURL/Belerofonte.png	Belerofonte	23
../img/semiDiosesURL/Asclepio.png	Asclepio	22
../img/semiDiosesURL/Aquiles.png	Aquiles	21
../img/diosesURL/Afrodita.png	Afrodita	20
../img/diosesURL/Apolo.png	Apolo	19
../img/diosesURL/Ares.png	Ares	18
../img/diosesURL/Artemisa.png	Artemisa	17
../img/diosesURL/Atenea.png	Atenea	16
../img/diosesURL/Hades.png	Hades	15
../img/diosesURL/Hefesto.png	Hefesto	14
../img/diosesURL/Hera.png	Hera	13
../img/diosesURL/Poseidon.png	Poseidon	12
../img/diosesURL/Zeus.png	Zeus\n	11
../img/BichosURL/Sirenas.png	Sirenas	10
../img/BichosURL/Quimera.png	Quimera	9
../img/BichosURL/Pegaso.png	Pegaso	8
../img/BichosURL/Minotauro.png	Minotauro	7
../img/BichosURL/Medusa.png	Medusa	6
../img/BichosURL/Hydra.png	Hydra	5
../img/BichosURL/Gigante.png	Gigante	4
../img/BichosURL/Cercopes.png	Cercopes	3
../img/BichosURL/Cerberus.png\n	Cerberus	2
../img/BichosURL/Aracne.png	Aracne	1
\.


--
-- TOC entry 3398 (class 0 OID 16889)
-- Dependencies: 219
-- Data for Name: invitado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.invitado ("invitadoID", "nombreInvitado", imagen_id) FROM stdin;
\.


--
-- TOC entry 3399 (class 0 OID 16893)
-- Dependencies: 220
-- Data for Name: jugadores_sala; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jugadores_sala (sala_jugadores_id, sala_id, jugador_id) FROM stdin;
\.


--
-- TOC entry 3401 (class 0 OID 16897)
-- Dependencies: 222
-- Data for Name: partidas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.partidas ("partidasId", "partidasGanadas", "partidasPerdidas", "usuarioId") FROM stdin;
4	5	3	67
\.


--
-- TOC entry 3403 (class 0 OID 16901)
-- Dependencies: 224
-- Data for Name: preguntas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.preguntas (pregunta_id, pregunta) FROM stdin;
1	¿Qué dioses son olímpicos?
2	¿Cuáles son criaturas mitológicas?
3	¿Cuáles personajes son semidioses?
4	¿Cuáles son los hijos de cronos?
5	¿Cuáles son titanes?
6	Forma un conjunto con criaturas del Inframundo
\.


--
-- TOC entry 3405 (class 0 OID 16905)
-- Dependencies: 226
-- Data for Name: sala; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sala (sala_id, nombre_sala, codigo_sala, creador_sala) FROM stdin;
\.


--
-- TOC entry 3408 (class 0 OID 16910)
-- Dependencies: 229
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuario ("usuarioID", "nombreUsuario", email, clave, imagen_perfil) FROM stdin;
67	carlos	carlosjavi1887@gmail.com	$2y$10$EIezpk6d9KueZz.O6qP8fuMjgpPO8Qo6B7lUIgArcmNULoE9icXjy	14
\.


--
-- TOC entry 3423 (class 0 OID 0)
-- Dependencies: 216
-- Name: imagen_binarios_id_imagen_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.imagen_binarios_id_imagen_seq', 42, true);


--
-- TOC entry 3424 (class 0 OID 0)
-- Dependencies: 218
-- Name: invitado_invitadoid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.invitado_invitadoid_seq', 28, true);


--
-- TOC entry 3425 (class 0 OID 0)
-- Dependencies: 221
-- Name: jugadores_sala_sala_jugadores_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jugadores_sala_sala_jugadores_id_seq', 1, false);


--
-- TOC entry 3426 (class 0 OID 0)
-- Dependencies: 223
-- Name: partidas_partidasid_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.partidas_partidasid_seq', 4, true);


--
-- TOC entry 3427 (class 0 OID 0)
-- Dependencies: 225
-- Name: preguntas_pregunta_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.preguntas_pregunta_id_seq', 11, true);


--
-- TOC entry 3428 (class 0 OID 0)
-- Dependencies: 227
-- Name: sala_sala_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sala_sala_id_seq', 36, true);


--
-- TOC entry 3429 (class 0 OID 0)
-- Dependencies: 228
-- Name: urlPerfil_id_url_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."urlPerfil_id_url_seq"', 15, true);


--
-- TOC entry 3430 (class 0 OID 0)
-- Dependencies: 230
-- Name: usuario_usuarioID_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."usuario_usuarioID_seq"', 67, true);


-- Completed on 2024-12-04 17:25:45

--
-- PostgreSQL database dump complete
--

