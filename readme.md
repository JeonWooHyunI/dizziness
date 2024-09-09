# [Dizziness Hash Algorithm With SHA-256]
**소개**<br>
Dizziness 알고리즘은 기존 해싱 알고리즘인 SHA-256에 더 강력한 보안옵션을 제공하는 사용자 정의 암호화 해싱 방식입니다.

**[특징]**
 - Dizziness 알고리즘은 Dizziness Key를 이용하여 SHA-256으로 해시된 값을 비트단위로 섞고 반복의 과정을 거치며 초기 해시 값을 더 복잡하게 만듭니다.
 - 기본 암호화는 블록 단위에서 이루어지며 각 블록에 진입한 입력값은 암호화를 거치며 두 블록으로 분리되고 하위블록들도 동일한 암호화를 수행합니다.
 - 다단계 블록 해싱으로 인해 결과 값이 무한대로 분산되며 이는 충돌 가능성을 줄여줄 뿐만아니라 더 복잡한 해시를 생성하게 해줍니다.
 - Dizziness는 생성가능한 블록의 수와 반복 횟수를 조절하며 해시 계산 시간을 기하 급수적으로 늘릴 수 있습니다. 이는 Brute-force attack에 대한 큰 저항성을 제공합니다.

**[검증]**
*연구가 더 필요함. <br>
 - 결정성 : diziness key와 input값이 동일하면 항상 같은 해시를 출력하도록 함.
 - 효율성 : 연산의 속도를 조정할 수 있어 실시간 사용이 가능함.
 - 충돌 저항성 : diziness키에 따른 다른 재배열 패턴을 가지고 있기에 충돌 저항성을 낮춤
 - 역상 저항성 : SHA-256의 기본 역상 저항성을 유지하면서 비트 섞기와 블록의 반복연산으로 인해 역추적하기에는 상상하기 힘든 연산이 필요.
 - 확산성 : SHA-256의 확산성 특성을 그대로 받음.
 - 확장 가능성 : 해시에 필요한 모든 인자를 사용자에게서 받음.


**Online Generator** <br>
https://jeonwoohyuni.com/dizziness/generator
---
**알고리즘 구조**<br>
<img src="https://raw.githubusercontent.com/JeonWooHyunI/dizziness_hash_algorithm_withSHA256/9abb0d4a01529ec924df50589619651f4ae9743a/algorithm.svg" width="500" height="500" />
---
**Target블록이 64개일때의 블록 개체도**<br>
<img src="https://mermaid.ink/svg/pako:eNqdlr9u2zAQxl9FYJYWsA2R1B9KQ4HEkuwMndKpVgYhlmMhtmXIMhInyFigQNZ4KJAO6dRuQZEWeabYeYcqPlIiNRSBPAi676fveHcmJF6hk3QYIxedZtF8rH3ywplW_PYHIdo-fn1-etBe1o_bmzsN9HdH_f02MS3tPMnHmpdcXiazeLF4H6Jjrd3-oB3gwebpdnP_XcPHPBPoROiE63A9wDvcrWxtYRSIVEh4DwggWiatXBwZFVJX7EJaT16xdAtIZCj8XUjtUamgysmhIcPSSQGaUr2Vk0NLhqXTAGhL7VRODpkM1W49aMjHg06nw4kHpfpE1qAIn8oapPcNWTNBM2XNAs2SNRs0W9YYaEzS4OpDlQEebP_cbX980Wp7SHBS46JXHzoKaI3TGjdq3BAcug_MGjdr3KpxS3CYVGDXuF3jrMaZ4DDVwJEm41t8Jros2lyU_0-fcbE-Huu1P3gmgAn2xE55_v3wsv7FEwQwnh6PqBIZSmQqkaVEthIxJXKUCOtqiNWwLAeE3i7sD_irZ3N_p21ufm7_rl--3fIO-rtHDkX_8Moqm1_kq0n8OoJRMpm4eyNn1FrkWXoWu3uUUn7fPk-G-dgl8wvFRJqYaBOT0cRkNjFZTUx2ExNrYnKamIot1cTVaE_gJpuiJzwj582ePvc4o7evc1jW9v91UAtN42waJcPi43_1miFE-TiexiFyi9thlJ2FKJxdF89Fyzw9Ws1OkJtny7iFsnR5OkbuKJosimg5H0Z57CVRcYKYluo8mn1OUyVG7hW6QC7R9Y7NGMbY0g2DWZi10KqQccekNjF1gxbQ0el1C13uMugdZjpEd4jj6Mw2iUFbKB4meZp9hKPL7gRz_Q9qF8x_" width="500" height="200" />