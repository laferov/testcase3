# testcase3 (in progress)

Написать 2 микросервиса которые общаются между собой по HTTP API, выполяющие функционал заказа такси.

## Сервис А

Должен иметь следующий функционал:

- создание водителя **done**
- отметка водителя на линии, не на линии **done**
- обновление местоположения водителя (можно взять сетку 1000х1000) **work, but not ok**

## Сервис Б

- создание заказа от и до точки
- автоназначение ближайшего водителя и расчет времени до заказа и до пункта назначения
- получение заказа

